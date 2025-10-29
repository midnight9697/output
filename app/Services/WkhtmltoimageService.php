<?php

namespace App\Services;

class WkhtmltoimageService {
    protected string $binary;

    public function __construct()
    {
        $this->binary = env('WKHTMLTOIMAGE_PATH');

        if (!file_exists($this->binary)) {
            throw new \Exception("wkhtmltoimage not found at {$this->binary}");
        }
    }

    public function generateFromHtml(string $html, string $outputPath, int $width = 1200, int $delay = 1000): string
    {
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
}
