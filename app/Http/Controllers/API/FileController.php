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
        $supplemental = Supplementary::where('id', $spl_id)->first();
        return $supplemental;
        if (!Gate::allows('pr-download-file', $supplemental)); {
            abort(403, 'Unauthorize action.');  //for tracking of PR
        }
        return Storage::disk('public')->download('supplemental/'.$supplemental);
    }
}
