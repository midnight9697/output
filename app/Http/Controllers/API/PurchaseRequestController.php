<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PR\CreatePrRequest;
use App\Http\Requests\PR\SearchPrRequest;
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
        return encryptIds(PurchaseRequest::query()->orderBy('created_at','asc')->with('members')->whereHas('members'));
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
        $new->member()->create([
            'user_id' => Auth::user()->id,
            'role' => 'admin',
            'added_by' => Auth::user()->id,
        ]);
        return $new;
    }

    public function fetch_pr_items($pr_id) {
        $pr_id = decryptUrlSafe($pr_id);
        $pr = PurchaseRequest::with('purchase_request_items')->find($pr_id);
        if (!Gate::allows('pr-update-view', $pr)) {
            abort(403, 'Unauthorize action.');
        }
        return encryptMany(PRItem::where('purchase_request_id', $pr_id)->get());
    }

    public function delete_pr($id) {
        $pr = PurchaseRequest::find($id);
        if (Gate::allows('pr-delete', $pr)) {
            abort(403, 'Unauthorize action.');
        }
        return $pr->delete();
    }
}