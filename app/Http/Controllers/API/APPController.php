<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\APP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class APPController extends Controller {
    protected $attachment_path = "public/app";
    
    public function remove(Request $request) {
        $id = decryptUrlSafe($request->id);
        $ppmp = APP::where('id', $id);
        $file = $ppmp->first()->filename.".".$ppmp->first()->filetype;
        if (Storage::disk('public')->exists('app/'.$file)) {
            Storage::delete('public/app/'.$file);
        }
        return $ppmp->delete();
    }

    public function fetch_by_page(Request $request) {
        $apps = APP::orderBy('created_at', 'desc');
        return encryptIds($apps);
    }

    public function uploadAttachment(Request $request) {
        $cnt = APP::whereMonth('created_at', date('m'))->count();
        $fakename = "APP-".date('Y')."-".date('m')."-".str_pad(($cnt + 1), 5, '0',STR_PAD_LEFT);
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
        return encryptSingle(APP::create($new_file_data));
    }
}
