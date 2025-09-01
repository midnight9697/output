<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplementary;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplementalController extends Controller {
    
    public function fetch_by_page(Request $request) {
        return Supplementary::paginate(10);
    }

    public function upload_file(Request $request) {
        $path = $request->file('sup_file')->storeAs('supplemental', $request->filename);
        return $path;
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
        
        $path = "supplemental/AUGUST 19 CA.pdf";
        $filename = "AUGUST 19 CA.pdf";
        $dompdf = new Dompdf();
        return $dompdf->stream($path);
    }
}
