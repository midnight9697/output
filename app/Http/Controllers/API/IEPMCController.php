<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IEPMC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IEPMCController extends Controller {

    protected $attachment_path = "public/iepmc";

    public function get_by_page(Request $request) {
        $iepmc = IEPMC::orderByDesc('created_at');
        return encryptIds($iepmc);
    }

    public function create(Request $request) {
        $data = [
            'document_number' => $request->document_number,
            'property_number' => $request->property_number,
            'issued_to' => $request->issued_to,
            'computer_name' => $request->computer_name,
            'brand_model' => $request->brand_model,
            'mac_address' => $request->mac_address,
            'serial_number' => $request->serial_number,
            'unit_location' => $request->unit_location,
            'assigned_to' => $request->assigned_to,
            'monitor_brand_model' => $request->monitor_brand_model,
            'printer' => $request->printer,
            'printer_serial_number' => $request->printer_serial_number,
            'ups_serial_number' => $request->ups_serial_number,
            'monitor_serial_number' => $request->monitor_serial_number,
            'date_last_maintenance' => $request->date_last_maintenance,
            'date_maintenance' => $request->date_maintenance,
            'inspected_by' => $request->inspected_by,
        ];
        $this->uploadUpdate($request);
        return IEPMC::create($data);
    }

    public function update(Request $request) {
        $data = [
            'document_number' => $request->document_number,
            'property_number' => $request->property_number,
            'issued_to' => $request->issued_to,
            'computer_name' => $request->computer_name,
            'brand_model' => $request->brand_model,
            'mac_address' => $request->mac_address,
            'serial_number' => $request->serial_number,
            'unit_location' => $request->unit_location,
            'assigned_to' => $request->assigned_to,
            'monitor_brand_model' => $request->monitor_brand_model,
            'printer' => $request->printer,
            'printer_serial_number' => $request->printer_serial_number,
            'ups_serial_number' => $request->ups_serial_number,
            'monitor_serial_number' => $request->monitor_serial_number,
            'date_last_maintenance' => $request->date_last_maintenance,
            'date_maintenance' => $request->date_maintenance,
            'inspected_by' => $request->inspected_by,
        ];
        $this->uploadUpdate($request);
        return IEPMC::update($data);
    }


    public function get_item($item_id) {
        $item_id = decryptUrlSafe($item_id);
        return encryptSingle(IEPMC::where('id', $item_id)->first());
    }

    public function uploadUpdate(Request $request) {
        $fakename = $request->document_number;
        $files = Storage::files($this->attachment_path."/".$fakename); // folder path relative to disk
        $fileCount = count($files);
        $file = $request->file('iepmc_file');
        $extension = $file->getClientOriginalExtension();
        $request->file('iepmc_file')->storeAs($this->attachment_path."/2025", $fakename.".".$extension, 'local');
        $uploadedFile = $request->file('iepmc_file');
        $filenameWithoutExtension = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $new_file_data = [
            'title' => $filenameWithoutExtension,
            'filename' => $fakename,
            'origin' => $request->filename,
            'filetype' => $extension,
            'creator' => Auth::user()->id,
        ];

        return ['Success' => 'shit', 'data' => $new_file_data];
    }
}
