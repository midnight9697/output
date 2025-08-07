<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PR\CreatePrRequest;
use App\Http\Requests\PR\SearchPrRequest;
use App\Models\PurchaseRequest;
use App\Models\User;
use App\Policies\PurchaseRequestPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\DataTables;

class PurchaseRequestController extends Controller {
    
    public function fetch_by_page() {
        if (!Gate::allows('pr-user-view')) {
            abort(403, 'Unauthorized action.');
        }
        $purchase_requests = DataTables::of(PurchaseRequest::query())->make(true);
        return $purchase_requests;
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
        $new = new PurchaseRequest();
        $new->create($request->all());
        return $new;
    }

    public function delete_pr($id) {
        $pr = PurchaseRequest::find($id);
        if (Gate::allows('pr-delete', $pr)) {
            abort(403, 'Unauthorize action.');
        }
        return $pr->delete();
    }
}