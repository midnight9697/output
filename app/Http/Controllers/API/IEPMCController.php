<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IEPMC;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Svg\Tag\Rect;
use Illuminate\Support\Str;

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
            'checkboxes' => $request->all()
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
            'checkboxes' => $request->all()
        ];
        $this->uploadUpdate($request);
        return IEPMC::where('id', decryptUrlSafe($request->iepmc_id))->update($data);
    }


    public function get_item($item_id) {
        $item_id = decryptUrlSafe($item_id);
        
        $iepmc = IEPMC::find($item_id);
        $checkboxes = $iepmc->checkboxes;
        $iepmc->makeHidden(['checkboxes']);
        $single = encryptSingle($iepmc);
        $single->checkboxes = $checkboxes;
        return $single;
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

    public function remove(Request $request) {
       $iepmc_id = decryptUrlSafe($request->id);
       $iepmc = IEPMC::where('id', $iepmc_id)->delete();
       return ['message' => 'success'];
    }

    public function stream($year = "2025", $iepmc_id) {
        $iepmc = IEPMC::where('id', decryptUrlSafe($iepmc_id));
        if (!$iepmc->exists()) {
            return ['NOT FOUND'];
        }
        $iepmc = IEPMC::where('id', decryptUrlSafe($iepmc_id))->first();
        $docxPath = public_path('storage/iepmc/'.$year."/".$iepmc->document_number.".docx");
                return response()->streamDownload(function () use ($docxPath) {
            echo file_get_contents($docxPath);
        }, $iepmc->document_number.".docx");
    }
    
    //     public function streamOffice(Request $request) {
    //         $url = 'https://view.officeapps.live.com/op/view.aspx?src=';
    //         return $url.url($request->path);
    // // ;        return redirect($url.url($request->path));
    //     }
    public function streamOffice($year, $iepmc_id) {
        // 1. Get your private file path
        $iepmc = IEPMC::where('id', decryptUrlSafe($iepmc_id));
        if (!$iepmc->exists()) {
            return ['NOT FOUND'];
        }
        $iepmc = IEPMC::where('id', decryptUrlSafe($iepmc_id))->first();

        $originalPath = "iepmc/".$year."/".$iepmc->document_number.".docx";
        // return $originalPath;
        Storage::disk('public')->makeDirectory('temp');
        // 2. Generate random temp filename
        $tempName = 'temp/' . Str::random(40) . '.docx';
        $url = 'https://view.officeapps.live.com/op/view.aspx?src=';
        $copied = Storage::disk('public')->copy($originalPath, $tempName);
        if (!$copied) {
            abort(500, 'Failed to create temp file');
        }
        // 4. Generate public URL
        $fileUrl = asset('storage/' . $tempName);
        // 5. Generate viewer URL
        $viewerUrl = "https://view.officeapps.live.com/op/view.aspx?src=" . ($fileUrl);

        // 6. Schedule deletion (important!)
        dispatch(function () use ($tempName) {
            Storage::disk('public')->delete($tempName);
        })->delay(now()->addMinutes(1));

        // 7. Return view or redirect
        // return $viewerUrl;
        return redirect($viewerUrl);
    }
    
    public function streamTemplate() {
        $docxPath = public_path('IEPMC.docx');
                return response()->streamDownload(function () use ($docxPath) {
            echo file_get_contents($docxPath);
        }, 'iepmc.docx');
    }
}
