<?php

namespace App\Http\Controllers;

use Google\Service\Drive;
use Illuminate\Http\Request;

class UploadAndConvertController extends Controller {
    public function uploadAndConvert()
{
    $client = $this->getClient();
    $client->setAccessToken(session('google_token'));

    $service = new Drive($client);

    $wordFile = storage_path('app/sample.docx');

    // Upload the Word file
    $fileMetadata = new \Google\Service\Drive\DriveFile([
        'name' => 'sample.docx',
    ]);

    $uploadedFile = $service->files->create($fileMetadata, [
        'data' => file_get_contents($wordFile),
        'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'uploadType' => 'multipart'
    ]);

    // Export it as PDF
    $fileId = $uploadedFile->id;
    $response = $service->files->export($fileId, 'application/pdf', ['alt' => 'media']);

    $pdfPath = storage_path('app/public/sample.pdf');
    file_put_contents($pdfPath, $response->getBody()->getContents());

    return response()->download($pdfPath);
}
}
