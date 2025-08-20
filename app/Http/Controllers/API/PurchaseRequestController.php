<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PR\CreatePrRequest;
use App\Http\Requests\PR\SearchPrRequest;
use App\Http\Requests\PR\UpdatePrRequest;
use App\Models\Member;
use App\Models\PRItem;
use App\Models\PurchaseRequest;
use App\Models\Recepient;
use App\Models\Transaction;
use App\Models\User;
use App\Policies\PurchaseRequestPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class PurchaseRequestController extends Controller {
    
    public function fetch_by_page() {
        if (!Gate::allows('pr-user-view')) {
            abort(403, 'Unauthorized action.');
        }
        $prs = PurchaseRequest::orderBy('id','desc')->with('createdBy')->whereHas('members', function($query) {
            return $query->where('members.user_id', Auth::user()->id);
        })->orWhereHas('lastTransaction', function($query) {
            return $query->whereHas('lastRecepient', function($q) {
                return $q->where('receiver_id', Auth::user()->id);
            });
        })->with('members')->with('lastTransaction');
        // return $prs->toSql();
        // PurchaseRequest::query()->orderBy('created_at','asc')->with('members')->whereHas('members')
        return encryptIds($prs);
    }

    public function fetch_all() {
        if (!Gate::allows('pr-user-view')) {
            abort(403, 'Unauthorized action.');
        }
        $purchase_requests = PurchaseRequest::get();
        return $purchase_requests;
    }

    public function search_pr(SearchPrRequest $request) {
        $columns = [
            'entity_name', 'fund_cluster', 'office', 'pr_number', 'date', 'responsibility_center_code', 'purpose'
        ];
        $keyword = $request->input('query');
        $result =  PurchaseRequest::where(function($q) use ($columns, $keyword) {
            foreach ($columns as $col) {
                $q->orWhere($col, 'LIKE', '%' . $keyword . '%');
            }
        })->paginate(10);
        return $result;
    }

    public function create_pr(CreatePrRequest $request, $id = null) {
        $request->merge(['created_by' => Auth::user()->id]);
        $request->merge(['created_in' => $request->date]);
        $new = PurchaseRequest::create($request->except('items'));
        $new->purchase_request_items()->createMany($request->items);
        $new->members()->create([
            'user_id' => Auth::user()->id,
            'role' => 'admin',
            'added_by' => Auth::user()->id,
        ]);

        $transaction = $new->transactions()->create([
            'body' => transactionBodies()->initiate,
            'sender_id' => Auth::user()->id,
        ]);
        $this->sendtoAll($new, $transaction);
        // John initiated the request
        return $new;
    }

    public function edit_pr(UpdatePrRequest $request, $pr_id = null) {
        $pr_id = decryptUrlSafe($pr_id);
        $pr = PurchaseRequest::find($pr_id);
        $request->merge(['created_in' => date('Y-m-d H:i:s', strtotime($request->date))]);
       
        $pr->fill($request->except(['items', 'date']));
        foreach ($request->items as $item) {
            $item_id = (isset($item['id'])?decryptUrlSafe($item['id']):null);
            $itemInstance = PRItem::find($item_id);
            if ($itemInstance) {
                $itemInstance->update($item);
            }
            else {
                $item['purchase_request_id'] = (int)$pr_id;
                PRItem::create($item);
            }
        }
        $updatedColumns = $pr->getDirty();
        $member_count = Member::where('purchase_request_id', $pr_id)->count();
        if (count($updatedColumns) > 0) {
            $transaction = $pr->transactions()->create([
                'body' => transactionBodies()->update,
                'sender_id' => Auth::user()->id,
            ]);
            if (count($updatedColumns) < 0 && ($member_count < count($request->members))) {
                $transaction = $pr->transactions()->create([
                    'body' => transactionBodies()->update_with_items,
                    'sender_id' => Auth::user()->id,
                ]);
            }
        }
        else {
            if (($member_count < count($request->members))) {
                $transaction = $pr->transactions()->create([
                    'body' => 'Updated the purchase request with a new member',
                    'sender_id' => Auth::user()->id,
                ]);
            }
        }

        foreach ($request->members as $member) {
            $mem = Member::where('user_id', $member['user_id'])->where('purchase_request_id', $pr_id);
            if (!$mem->exists()) {
                Member::create([
                    'user_id' => $member['user_id'],
                    'purchase_request_id' => $pr_id,
                    'added_by' => Auth::user()->id,
                    'role' => $member['role']
                ]);
            }
            if (count($updatedColumns) > 0) {
                Recepient::create([
                    'transaction_id' => $transaction->id,
                    'receiver_id' => $member['user_id']
                ]);
            }
        }
        $pr->save();
        return $updatedColumns;
    }

    public function fetch_pr_items($pr_id) {
        $pr_id = decryptUrlSafe($pr_id);
        $pr = PurchaseRequest::with('members')->find($pr_id);
        $transactions = Transaction::where('purchase_request_id', $pr->id)->with('sender')->with('act')->orderBy('id', 'desc')->paginate(10);
        if (!Gate::allows('pr-update-view', $pr)) {
            abort(403, 'Unauthorize action.');
        }
        return ['pr' => encryptSingle($pr), 'transactions' => encryptMany($transactions), 'items' => encryptMany(PRItem::where('purchase_request_id', $pr_id)->get())];
    }

    public function make_transaction(Request $request) {
        $pr_id = decryptUrlSafe($request->pr_id);
        $action = decryptUrlSafe($request->action);
        // $action = decryptUrlSafe($request->action);
        $pr = PurchaseRequest::with('members')->find($pr_id);

        $transaction = $pr->transactions()->create([
            'body' => $request->body,
            'sender_id' => Auth::user()->id,
            'action' => $action
        ]);

        if (!isset($request->assigned_to)) {
            $this->sendtoAll($pr, $transaction);
        }
        else {
            PurchaseRequest::where('id', $pr_id)->update([
                'approval' => 1
            ]);

            Recepient::create([
                'transaction_id' => $transaction->id,
                'receiver_id' => decryptUrlSafe($request->assigned_to)
            ]);
        }
        return $transaction;
    }

    public function sendtoAll($pr, $transaction) {
        foreach (Member::where('purchase_request_id', $pr->id)->get() as $member) {
            Recepient::create([
                'transaction_id' => $transaction->id,
                'receiver_id' => $member->user_id
            ]);
        }
    }

    public function delete_pr($id) {
        $pr = PurchaseRequest::find($id);
        if (Gate::allows('pr-delete', $pr)) {
            abort(403, 'Unauthorize action.');
        }
        return $pr->delete();
    }

    public function route_pr(Request $request) {
        return $this->make_transaction($request);
    }

    public function receive_pr(Request $request) {
        $pr_id = decryptUrlSafe($request->pr_id);
        $tr = Transaction::where('purchase_request_id', $pr_id)->orderBy('id', 'desc')->with('lastRecepient')->first();
        $rc = Recepient::where('id', $tr->lastRecepient->id)->update([
            'received' => '1'
        ]);
        return ['rc' => $rc, 'id' => $tr->lastRecepient->id];
    }
}