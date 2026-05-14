<?php

namespace App\Services;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class GoogleDriveService
{
    private $service;

    public function __construct()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        $client->addScope(Drive::DRIVE);

        $this->service = new Drive($client);
    }

    public function uploadFile($filePath, $fileName, $folderId = null)
    {
        $fileMetadata = new DriveFile([
            'name' => $fileName,
        ]);

        if ($folderId) {
            $fileMetadata->setParents([$folderId]);
        }

        $content = file_get_contents($filePath);

        $file = $this->service->files->create(
            $fileMetadata,
            [
                'data' => $content,
                'mimeType' => mime_content_type($filePath),
                'uploadType' => 'multipart',
                'fields' => 'id'
            ]
        );

        return $file->id;
    }
}