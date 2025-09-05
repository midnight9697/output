<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PRSupplemental;
use App\Models\Supplementary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller {
    
    public function supplemental($pr_spl_id) {
        $pr_spl_id = decryptUrlSafe($pr_spl_id);
        $pr_spl = PRSupplemental::where('id', $pr_spl_id)->first();
        Gate::allows('spl-download-file', $pr_spl);
        
        $supplemental = Supplementary::where('id', $pr_spl->supplemental_id)->first();
        $file = $supplemental->filename.".".$supplemental->filetype;
        return Storage::disk('public')->download('supplemental/'.$file);
    }
}
