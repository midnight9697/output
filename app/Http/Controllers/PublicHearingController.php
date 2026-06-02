<?php

namespace App\Http\Controllers;

use App\Models\PublicHearing;
use Illuminate\Http\Request;

class PublicHearingController extends Controller {
    
    public function getPHDataTable() {
        $ps = PublicHearing::orderBy('id', 'desc');
        return  encryptIds($ps);
    }

    public function insertPH(Request $request) {
        return PublicHearing::create([
            'tentative_date_and_time' => $request->tentative_date_and_time,
            'public_hearing_location' => $request->public_hearing_location,
            'project_name' => $request->project_name,
            'project_proponent' => $request->project_proponent,
            'project_location' => $request->project_location,
            'project_description'=> $request->project_description,
        ]);
    }

    public function updatePH(Request $request) {
        $ps = PublicHearing::find(decryptUrlSafe($request->id));
        $ps->update([
            'tentative_date_and_time' => $request->tentative_date_and_time,
            'public_hearing_location' => $request->public_hearing_location,
            'project_name' => $request->project_name,
            'project_proponent' => $request->project_proponent,
            'project_location' => $request->project_location,
            'project_description'=> $request->project_description,
        ]);
        return  PublicHearing::where('id', decryptUrlSafe($request->id))->first();
    }

    public function removePH(Request $request) {
        return PublicHearing::where('id' ,decryptUrlSafe($request->id))->delete();
    }
}
