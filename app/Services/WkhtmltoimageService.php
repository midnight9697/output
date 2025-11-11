<?php

namespace App\Services;

use App\Models\TemporaryImages;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\ImageManagerStatic as Image;

class WkhtmltoimageService {
    protected string $binary;
    protected $service;

    public function __construct() {
        $this->binary = base_path(env('WKHTMLTOIMAGE_PATH'));
        $this->service = $this;
        if (!file_exists($this->binary)) {
            throw new \Exception("wkhtmltoimage not found at {$this->binary}");
        }
    }

    public function generateFromHtml(string $html, string $outputPath, $number, int $width = 1200, int $delay = 1000): string {
        // Save HTML to a temporary file
        $tempHtml = tempnam(sys_get_temp_dir(), 'html') . '.html';
        file_put_contents($tempHtml, $html);
    
        // Wrap all paths in double quotes — avoids space issues
        $binary = '"' . $this->binary . '"';
        $tempHtmlQuoted = '"file:///' . str_replace('\\', '/', $tempHtml) . '"';
        $outputPathQuoted = '"' . $outputPath . '"';
    
        // Build command safely
        $cmd = "{$binary} --enable-local-file-access --width {$width} --javascript-delay {$delay} {$tempHtmlQuoted} {$outputPathQuoted} 2>&1";
    
        // Run command
        exec($cmd, $output, $resultCode); 
    
        unlink($tempHtml);
    
        if ($resultCode !== 0) {
            throw new \Exception("wkhtmltoimage failed: " . implode("\n", $output));
        }
        
        return $outputPath;
    }

    public function GeneratePdf($html, $title = "Generated Pdf") {
        $datetime = date('Y-m-d H:i:s');
        $number = strtotime($datetime);
        $outputPath = public_path('files/abstract/images/'.$number.'.png');
        $this->service->generateFromHtml($html, $outputPath, $number);
        $imagePath = $outputPath;
        $img = Image::make($imagePath);
        $width = $img->width();
        $height = $img->height();
        $pageHeight = 794;//$canvas->get_height();
        $numSlices = ceil($height / $pageHeight);
       
        $slices = [];
        
        for ($i = 0; $i < $numSlices; $i++) {
            $y = $i * $pageHeight;
            $sliceHeight = min($pageHeight, $height - $y);
            $sliceImg = clone $img;
            $slice = $sliceImg->crop((float)$width, (float)$sliceHeight, 0, (float)$y);
            $slices[] = (object)['file' => base64_encode((string) $slice->encode('png')), 'height' => $sliceHeight];
        }
        
        $html = '';
        foreach ($slices as $key => $slice) {
            $maxHeight = ($key == 0?$slice->height - 93:$slice->height);
            $base64 = ($slice->file);
            $html = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>{$title}</title>
            </head>
            <body>
                <img src="data:image/png;base64,{$base64}" alt="Generated Image" width="100%">
            </body>
            </html>
            HTML;
        }
        $pdf = Pdf::loadHTML($html)->setPaper('A4', 'landscape');
        unlink($outputPath);
        return $pdf->stream($title);
    }
}
