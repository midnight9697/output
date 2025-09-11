<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\PRSupplemental;
use App\Models\PurchaseRequest;
use App\Models\Supplementary;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {
    protected $attachment_path = "public/attachments";
    
    public function supplemental($pr_spl_id) {
        $pr_spl_id = decryptUrlSafe($pr_spl_id);
        $pr_spl = PRSupplemental::where('id', $pr_spl_id);
        if (!$pr_spl->exists()) {
            return abort('404', 'Not Found');
        }
        $pr_spl = $pr_spl->first();
        Gate::allows('spl-download-file', $pr_spl);
        
        $supplemental = Supplementary::where('id', $pr_spl->supplemental_id)->first();
        $file = $supplemental->filename.".".$supplemental->filetype;
        if (!Storage::disk('public')->exists('supplemental/'.$file)) {
            return abort('404', 'File Not Found');
        }
        return Storage::disk('public')->download('supplemental/'.$file, $supplemental->origin);
    }

    public function attachment($pr_spl_id) {
        $pr_spl_id = decryptUrlSafe($pr_spl_id);
        $pr_spl = Attachment::where('id', $pr_spl_id);
        
        if (!$pr_spl->exists()) {
            return abort('404', 'Not Found');
        }
        
        $pr_spl = $pr_spl->first();
        $transaction = Transaction::where('id', $pr_spl->transaction_id)->first();
        Gate::allows('attachment-file-view', $pr_spl);
        $file = $pr_spl->filename.".".$pr_spl->filetype;
        if (!Storage::disk('public')->exists('attachments/'.$file)) {
            return abort('404', 'File Not Found');
        }
        return Storage::disk('public')->download('attachments/'.$file, $pr_spl->origin);
    }

    public function viewSupplemental($spl_id) {
        $spl_id = decryptUrlSafe($spl_id);
        $supplemental = Supplementary::where('id', $spl_id);
        if (!$supplemental->exists()) {
            return abort('404', 'Not Found');
        }
        $supplemental = $supplemental->first();
        Gate::allows('spl-view-file', $supplemental);

        $file = $supplemental->filename.".".$supplemental->filetype;
        if (!Storage::disk('public')->exists('supplemental/'.$file)) {
            return abort('404', 'File Not Found');
        }
        return Storage::disk('public')->download('supplemental/'.$file, $supplemental->origin);
    }

    public function uploadAttachment(Request $request) {
        $cnt = Attachment::whereMonth('created_at', date('m'))->count();
        $fakename = "ATT-".date('Y')."-".date('m')."-".str_pad(($cnt + 1), 5, '0',STR_PAD_LEFT);
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
            'user_id' => Auth::user()->id,
            // 'transaction_id' => $transaction->id
        ];
        return encryptSingle(Attachment::create($new_file_data));
    }
}
