<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PR\CreatePrRequest;
use App\Http\Requests\PR\SearchPrRequest;
use App\Http\Requests\PR\UpdatePrRequest;
use App\Models\Member;
use App\Models\PRItem;
use App\Models\PurchaseRequest;
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
        $prs = PurchaseRequest::query()->orderBy('created_at','asc')->with('createdBy')->with('members')->whereHas('members', function($query) {
            return $query->where('user_id', Auth::user()->id);
        });
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
        $request->merge(['created_at' => $request->date]);
        $new = PurchaseRequest::create($request->except('items'));
        $new->purchase_request_items()->createMany($request->items);
        $new->members()->create([
            'user_id' => Auth::user()->id,
            'role' => 'admin',
            'added_by' => Auth::user()->id,
        ]);
        return $new;
    }

    public function edit_pr(UpdatePrRequest $request, $pr_id = null) {
        $pr_id = decryptUrlSafe($pr_id);
        $pr = PurchaseRequest::find($pr_id);
        $pr->update($request->except('items'));
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

        foreach ($request->members as $member) {
            if (!Member::where('user_id', $member['user_id'])->where('purchase_request_id', $pr_id)->exists()) {
                Member::create([
                    'user_id' => $member['user_id'],
                    'purchase_request_id' => $pr_id,
                    'added_by' => Auth::user()->id,
                    'role' => $member['role']
                ]);
            }
        }
        return $pr;
    }

    public function fetch_pr_items($pr_id) {
        $pr_id = decryptUrlSafe($pr_id);
        $pr = PurchaseRequest::with('members')->find($pr_id);
        if (!Gate::allows('pr-update-view', $pr)) {
            abort(403, 'Unauthorize action.');
        }
        return ['pr' => encryptSingle($pr), 'items' => encryptMany(PRItem::where('purchase_request_id', $pr_id)->get())];
    }

    public function delete_pr($id) {
        $pr = PurchaseRequest::find($id);
        if (Gate::allows('pr-delete', $pr)) {
            abort(403, 'Unauthorize action.');
        }
        return $pr->delete();
    }
}