<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PR\CreatePrRequest;
use App\Http\Requests\PR\SearchPrRequest;
use App\Http\Requests\PR\UpdatePrRequest;
use App\Models\Attachment;
use App\Models\Member;
use App\Models\PRItem;
use App\Models\PRSupplemental;
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
        
        $prs = PurchaseRequest::whereHas('members', function($query) {
            return $query->where('members.user_id', Auth::user()->id);
        })->orWhereHas('lastTransaction', function($query) {
            return $query->whereHas('lastRecepient', function($q) {
                return $q->where('receiver_id', Auth::user()->id);
            });
        });
        
        return encryptIds($this->pr_data_fetcher($prs));
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
            // if ((count($updatedColumns) > 0 || $pr->transactions()->getDirty())) {
                Recepient::create([
                    'transaction_id' => $transaction->id,
                    'receiver_id' => $member['user_id']
                ]);
            // }
        }
        $pr->save();
        return $updatedColumns;
    }
    
    public function fetch_pr_items($pr_id) {
        $pr_id = decryptUrlSafe($pr_id);
        $pr = PurchaseRequest::with('members')->find($pr_id);
        
        if (Member::where('purchase_request_id', $pr_id)->where('user_id', Auth::user()->id)->exists()) {
            $transactions = Transaction::where('purchase_request_id', $pr->id)->with('sender')->with('act')->orderBy('id', 'desc')->with('recepient')->whereHas('recepient')->with('recepients')->with('spl');
        }
        else {
            $transactions = Transaction::where('purchase_request_id', $pr->id)->whereHas('recepient', function($query) use($pr_id) {
                $first_received = Transaction::where('purchase_request_id', $pr_id)->orderBy('id', 'asc')->whereHas('firstRecepient', function($query) {
                    return $query->where('receiver_id', Auth::user()->id);
                })->with('firstRecepient')->first();
                return $query->where('created_at', '>=',$first_received->firstRecepient->created_at);
            })->with('sender')->with('act')->orderBy('id', 'desc')->with('recepient')->with('recepients')->with('spl');
        }
        
        if (!Gate::allows('pr-track-view', $pr)) {
            // if (!Gate::allows('pr-file-view', $pr_id)) { 
                abort(403, 'Unauthorize action.');  //for tracking of PR
            // }
        }
        return ['pr' => encryptSingle($pr), 'transactions' => encryptMany($transactions->with('attachments')->paginate(10)), 'items' => encryptMany(PRItem::where('purchase_request_id', $pr_id)->get())];
    }
    
    public function make_transaction(Request $request) {
        $pr_id = decryptUrlSafe($request->pr_id);
        $action = decryptUrlSafe($request->action);
        $pr = PurchaseRequest::with('members')->find($pr_id);
        $assigned = (isset($request->assigned_to)?decryptUrlSafe($request->assigned_to):false);
        $transaction = $pr->transactions()->create([
            'body' => $request->body,
            'sender_id' => Auth::user()->id,
            'action' => $action
        ]);
        
        if (isset($request->supplemental)) {
             $saveData = [];
             foreach ($request->supplementary as $spl) {
                 $saveData[] = [
                     'supplemental_id' => $spl,
                     'purchase_request_id' => $pr_id,
                     'transaction_id' => $transaction->id
                 ];
            }

            PRSupplemental::insert($saveData);
        }

        if (isset($request->attachments)) {
            foreach ($request->attachments as $attachment) {
                $att_id = decryptUrlSafe($attachment['id']);
                Attachment::where('id', $att_id)->update([
                    'transaction_id' => $transaction->id
                ]);
            }
        }

        if (!isset($request->assigned_to)) {
            $this->sendtoAll($pr, $transaction);
        }
        else {
            PurchaseRequest::where('id', $pr_id)->update([
                'approval' => 1
            ]);
            
            Recepient::create([
                'transaction_id' => $transaction->id,
                'receiver_id' => $assigned
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

    public function generate_pr_number(Request $request) {
        $pr_id = decryptUrlSafe($request->id);
        $cnt = PurchaseRequest::whereMonth('created_at', date('m'))->whereNotNull('pr_number')->count();

        PurchaseRequest::where('id', $pr_id)->update([
           'pr_number' =>  "PR-".date('Y')."-".date('m')."-".str_pad(($cnt + 1), 3, '0',STR_PAD_LEFT)
        ]);
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

    public function decrypt_action(Request $request){
        return decryptUrlSafe($request->action);
    }

    public function fetch_close_pr_by_page(){
        $close_pr =  PurchaseRequest::with('close_pr')->whereHas('transactions', function($query) {
            return $query->where('sender_id', Auth::user()->id)
                    ->where('action' , 12);
        });
        return encryptIds($this->pr_data_fetcher($close_pr));
    }

    public function fetch_track_pr_by_page(){
        $pr =  PurchaseRequest::where('approval', NULL)->whereHas('members', function($query) {
            return $query->where('members.user_id', Auth::user()->id);
        })->orderBy('created_at', 'desc');
        return encryptIds($this->pr_data_fetcher($pr));
    }
    
    public function fetch_outbox_pr_by_page(){
        $pr =  PurchaseRequest::where('approval', '1')->whereHas('lastTransaction', function($query) {
            return $query->whereHas('recepient', function($q) {
                return $q->where('receiver_id', '!=', Auth::user()->id);
            });
        })->whereHas('transactions', function($query) {
            return $query->where('sender_id', Auth::user()->id)
                    ->orWhereHas('recepient', function($q) {
                return $q->where('receiver_id', Auth::user()->id);
            });
        });
        // return ['user' => Auth::user(), 'pr' => $pr->get()];
        return encryptIds($this->pr_data_fetcher($pr));
    }

    public function fetch_inbox_pr_by_page(){

        $prequest = new PurchaseRequest();
        $pr = $prequest->where('approval', 1)
            ->whereHas('lastTransaction', function($query) {
            return $query->whereHas('recepient', function($q) {
                return $q->where('receiver_id', Auth::user()->id);
            });
        });
        
        $pr->orderByDesc(
            Transaction::select('created_at')
                ->whereColumn('transactions.purchase_request_id', 'purchase_requests.id')
                ->latest()
                ->take(1)
        );
        return encryptIds($this->pr_data_fetcher($pr));
    }

    public function pr_data_fetcher($query) {
        return $query->withAggregate('lastTransaction', 'created_at as latest_date')
        ->withAggregate('createdBy','CONCAT(firstname, " ", lastname) as fullname')
        ->with('members')
        ->with('lastTransaction')
        ->with('createdBy');
        // ->orderBy('desc', 'last_transaction_created_at_as_latest_date');
    }
}