<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PPMP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PPMPController extends Controller {
    protected $attachment_path = "public/ppmp";

    public function fetch_by_page(Request $request) {
        $ppmps = PPMP::orderBy('created_at', 'desc');
        return encryptIds($ppmps);
    }

    public function remove(Request $request) {
        $id = decryptUrlSafe($request->id);
        return PPMP::where('id', $id)->delete();
    }

    public function uploadAttachment(Request $request) {
        return $request;
        $cnt = PPMP::whereMonth('created_at', date('m'))->count();
        $fakename = "PPMP-".date('Y')."-".date('m')."-".str_pad(($cnt + 1), 5, '0',STR_PAD_LEFT);
        $file = $request->file('att_file');
        $extension = $file->getClientOriginalExtension();
        $request->file('att_file')->storeAs($this->attachment_path, $fakename.".".$extension, 'local');
        $uploadedFile = $request->file('att_file');
        $filenameWithoutExtension = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $new_file_data = [
            'title' => $filenameWithoutExtension,
            'filename' => $fakename,
            'origin' => $request->filename,
            'filetype' => $extension,
            'creator' => Auth::user()->id,
        ];
        return encryptSingle(PPMP::create($new_file_data));
    }
}
