<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplementary;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SupplementalController extends Controller {
    protected $path = "public/supplemental";
    
    public function fetch_by_page(Request $request) {
        $spls = Supplementary::with('uploader')->orderBy('created_at', 'desc');
        return encryptIds($spls);
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
        return response()->streamDownload(function () use ($path) {
            $stream = fopen($path, 'r');
            while (!feof($stream)) {
                echo fread($stream, 1024 * 8); // Read in chunks (e.g., 8KB)
                flush(); // Flush output buffer
            }
            fclose($stream);
        }, $request->filename, [
            'Content-Type' => Storage::mimeType($path), // Get correct MIME type
            'Content-Length' => Storage::size($path), // Optional, for progress bars
        ]);
    }

    public function show() {
        $path = "supplemental/SPL-2025-09-00006.pdf";
        $filename = "AUGUST 19 CA.pdf";
        return Storage::disk('public')->download('supplemental/SPL-2025-09-00006.pdf');
    }
}
