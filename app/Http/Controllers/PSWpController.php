<?php

namespace App\Http\Controllers;

use App\Models\PublicScoping;
use Illuminate\Http\Request;

class PSWpController extends Controller {

    public function dashboardView() {
        return view('scoping.dashboard', [
            'ps_count' => PublicScoping::count()
        ]);
    }

    public  function importCsv() {
        // Read the file content
        $file = storage_path('app\data-v3.csv');
    
        // Decode JSON into PHP array
        // $data = json_decode($jsonString, true); // true = associative array
        $data = [];
        PublicScoping::truncate();
        
        if (($handle = fopen($file, 'r')) !== false) {
            $header = null; // will store the header row
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                if (!$header) {
                    $header = $row; // first row as header
                } else {
                    $data[] = array_combine($header, $row); // combine header + row
                }
            }
            fclose($handle);
        }
    
        // Use the data
        foreach ($data as $item) {
            $objects = array_keys($item);
            $obj = [];
            foreach ($objects as $key) {
                $obj[] = $item[$key];
            }
            $dt = PublicScoping::insert([
                'id' => $obj[0],
                'tentative_date_and_time' => $obj[1],
                'public_scoping_location' => $obj[2],
                'project_name' => $obj[3],
                'project_proponent' => $obj[4],
                'project_location' => $obj[5],
                'project_description'=> $obj[7],
            ]);
        }
        return ['success' => 'message'];
    }

    public function getRawData() {
        $ps = PublicScoping::orderBy('id', 'desc')->get();
        return $ps;
    }

    public function getPSDataTable() {
        $ps = PublicScoping::orderBy('id', 'desc');
        return  encryptIds($ps);
    }

    public function insertPS(Request $request) {
        return PublicScoping::create([
            'tentative_date_and_time' => $request->tentative_date_and_time,
            'public_scoping_location' => $request->public_scoping_location,
            'project_name' => $request->project_name,
            'project_proponent' => $request->project_proponent,
            'project_location' => $request->project_location,
            'project_description'=> $request->project_description,
        ]);
    }

    public function updatePS(Request $request) {
        $ps = PublicScoping::find(decryptUrlSafe($request->id));
        $ps->update([
            'tentative_date_and_time' => $request->tentative_date_and_time,
            'public_scoping_location' => $request->public_scoping_location,
            'project_name' => $request->project_name,
            'project_proponent' => $request->project_proponent,
            'project_location' => $request->project_location,
            'project_description'=> $request->project_description,
        ]);
        return  PublicScoping::where('id', decryptUrlSafe($request->id))->first();
    }

    public function removePS(Request $request) {
        return PublicScoping::where('id' ,decryptUrlSafe($request->id))->delete();
    }

    public function PSView() {
        return view('scoping.scoping');
    }

    public function PHView() {
        return view('scoping.hearing');
    }

}
