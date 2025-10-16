<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AbstractModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ABSTRACTController extends Controller {
    
    public function fetch_by_page(Request $request) {
        $abs = AbstractModel::orderBy('created_at', 'desc');
        return encryptIds($abs);
    }

    public function create(Request $request) {
        $new = AbstractModel::create([
            'ref' => $request->ref,
            'purpose' => $request->purpose,
            'filename' => $request->filename,
            'origin' => $request->origin,
            'filetype' => $request->filetype,
            'creator' => Auth::user()->id,
        ]);
    }
}
