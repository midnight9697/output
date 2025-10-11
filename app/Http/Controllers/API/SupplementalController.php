<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SupplementalProject;
use App\Models\Supplementary;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SupplementalController extends Controller {
    protected $path = "public/supplemental";
    
    public function fetch_by_page(Request $request) {
        $spls = Supplementary::with('uploader')->orderBy('created_at', 'desc');
        return encryptIds($spls);
    }

    public function create(Request $request) {
        $new_supplemental = Supplementary::create(['title' => $request->title, 'user_id' => Auth::user()->id]);
        $projects = [];
        foreach ($request->projects as $project) {
            $project = (object)$project;
            $projects[] = SupplementalProject::create( [
                'supplemental_id' => $new_supplemental->id,
                'code' => $project->code,
                'procurement_project' => $project->procurement_project,
                'end_user' => $project->end_user,
                'early_procurement' => $project->early_procurement,
                'mode_of_procurement' => $project->mode_of_procurement,
                'advertisement' => $project->advertisement,
                'submission' => $project->submission,
                'notice_of_award' => $project->notice_of_awards,
                'contract_signing' => $project->contract_signing,
                'source_of_funds' => $project->source_of_funds,
                'total' => $project->total,
                'mooe' => $project->mooe,
                'co' => $project->co,
            ]);
        }

        return ['supplemental' => $new_supplemental, 'projects' => $projects];
    }

    public function upload_file(Request $request) {
        
        $cnt = Supplementary::whereMonth('created_at', date('m'))->count();
        $fakename = "SPL-".date('Y')."-".date('m')."-".str_pad(($cnt + 1), 5, '0',STR_PAD_LEFT);
        $file = $request->file('sup_file');
        $extension = $file->getClientOriginalExtension();
        $path = $request->file('sup_file')->storeAs($this->path, $fakename.".".$extension);
        $uploadedFile = $request->file('sup_file');
        $filenameWithoutExtension = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $new_file_data = [
            'title' => $filenameWithoutExtension,
            'filename' => $fakename,
            'origin' => $request->filename,
            'filetype' => $extension,
            'user_id' => Auth::user()->id
        ];
        
        Supplementary::create($new_file_data);
        return $new_file_data;
    }

    public function rmvFile(Request $request) {
        $supplemental = Supplementary::where('id', decryptUrlSafe($request->id));
        if (!$supplemental->exists()) {
            return abort('404', 'Not Found');
        }
        if (!Gate::allows('spl-view-file', $supplemental->first())) {
            return abort('404', 'Unauthorized Access');
        }
        
        $file = $supplemental->first()->filename.".".$supplemental->first()->filetype;
        $supplemental->delete();
        if (Storage::disk('public')->exists('supplemental/'.$file)) {
            Storage::delete('public/supplemental/'.$file);
        }
        return ['success'];
    }

    public function show() {
        $path = "supplemental/SPL-2025-09-00006.pdf";
        $filename = "AUGUST 19 CA.pdf";
        return Storage::disk('public')->download('supplemental/SPL-2025-09-00006.pdf', );
    }
}
