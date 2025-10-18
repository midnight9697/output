<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Profile;
use App\Models\PurchaseRequest;
use App\Models\RFQ;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller {    

    public function homeView(Request $request) {
        $count_user = User::count();
        $count_supplier = Supplier::count();
        $count_pr = PurchaseRequest::where('created_by', Auth::user()->id)->count();
        $count_rfq = RFQ::where('creator', Auth::user()->id)->count();
        
        return view('admin.home',compact('count_user', 'count_pr', 'count_supplier' , 'count_rfq'));
    }
}