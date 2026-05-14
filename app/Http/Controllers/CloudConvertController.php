<?php

namespace App\Http\Controllers;

use App\Services\GoogleDriveService;
use Illuminate\Http\Request;
use CloudConvert\CloudConvert;
use CloudConvert\Models\Job;
use CloudConvert\Models\Task;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Writer\PDF\DomPDF;

class CloudConvertController extends Controller {

    public function Cloud() {
        return view('cloud');
    }

    public function convert(Request $request) {
        // $request->validate([
        //     'file' => 'required|mimes:doc,docx'
        // ]);

        $cloudconvert = new CloudConvert([
            'api_key' => env('CLOUDCONVERT_KEY'),
            'http_client' => new \GuzzleHttp\Client([
                'verify' => false,
            ])
        ]);

        // Create job
        $job = (new Job())
            ->addTask(
                (new Task('import/upload', 'upload-file'))
            )
            ->addTask(
                (new Task('convert', 'convert-file'))
                    ->set('input', 'upload-file')
                    ->set('output_format', 'pdf')
            )
            ->addTask(
                (new Task('export/url', 'export-file'))
                    ->set('input', 'convert-file')
            );

        // Create job in CloudConvert
        $job = $cloudconvert->jobs()->create($job);

        // Upload file
        $uploadTask = $job->getTasks()->whereName('upload-file')[0];

        $cloudconvert->tasks()->upload(
            $uploadTask,
            fopen($request->file('file')->getRealPath(), 'r'),
            $request->file('file')->getClientOriginalName()
        );

        // Wait until conversion finished
        $job = $cloudconvert->jobs()->wait($job);

        // Get export task
        $exportTask = $job->getTasks()->whereName('export-file')[0];

        // Get file URL
        // $files = $exportTask->getResult()['files'];
        $files = $exportTask->getResult()->files;
        return redirect($files[0]['url']);
        return response()->json([
            'pdf_url' => $files[0]['url']
        ]);
    }

    public function office() {
        $phpWord = IOFactory::load('IEPMC.docx');
        // Set PDF renderer
        Settings::setPdfRenderer(
            Settings::PDF_RENDERER_DOMPDF,
            base_path('vendor/dompdf/dompdf')
        );
        $htmlWriter = IOFactory::createWriter($phpWord, 'PDF');

        $htmlWriter->save('output.pdf');

        echo "Converted successfully!";
    }

    public function google(Request $request, GoogleDriveService $drive) {
        $request->validate([
            'file' => 'required|file'
        ]);

        $file = $request->file('file');

        $fileId = $drive->uploadFile(
            $file->getPathname(),
            $file->getClientOriginalName()
        );

        return response()->json([
            'file_id' => $fileId
        ]);
    }
}
