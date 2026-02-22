<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Illuminate\Http\Request;

class UploadAndConvertController extends Controller {

    public function uploadAndConvert() {
    // $client = $this->getClient();
    // $client->setAccessToken(session('google_token'));
    $client = new Client();
    $client->setAuthConfig(storage_path('app/google-service-account.json'));
    $client->addScope(Drive::DRIVE);
    $service = new Drive($client);

    $wordFile = public_path('WORD RFQ WITH HEADER.docx');

    // Upload the Word file
    // $fileMetadata = new \Google\Service\Drive\DriveFile([
    //     'name' => 'sample.docx',
    //     'parents' => ['16gyffHK-cJAEHTseBnxmonmGrr5vFUi0'], // Folder inside Shared Drive
    // ]);

    $fileMetadata = new DriveFile([
        'name' => 'myfile.docx',
        'parents' => ['16gyffHK-cJAEHTseBnxmonmGrr5vFUi0'], // Folder inside Shared Drive
    ]);

    $content = file_get_contents($wordFile);

    $file = $service->files->create($fileMetadata, [
        'data' => $content,
        'mimeType' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'uploadType' => 'multipart',
        // 'supportsAllDrives' => true,
        'fields' => 'id'
    ]);
    $permission = new \Google\Service\Drive\Permission([
        'type' => 'anyone',
        'role' => 'editor',
    ]);

    $service->permissions->create($file->id, $permission);

    return response()->json([
        'file_id' => $file->id
    ]);

    return response()->download($pdfPath);
}
}
