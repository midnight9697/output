<?php

namespace App\Services;

use App\Models\TemporaryImages;
use Barryvdh\DomPDF\Facade\Pdf;
use Intervention\Image\ImageManagerStatic as Image;
use OpenAI;

class ParaphraserService {
    protected $client;
    // public function __construct() {
    //     $this->client = OpenAI::client(env('OPENAI_API_KEY'));
    // }

    // public function rephrase(string $text): string {
    //     $response = $this->client->chat()->create([
    //         'model' => 'gpt-3.5-turbo',  // compatible and cheaper for paraphrasing
    //         'messages' => [
    //             ['role' => 'system', 'content' => 'You rephrase text to make it clearer and more professional.'],
    //             ['role' => 'user', 'content' => "Rephrase this: {$text}"],
    //         ],
    //     ]);

    //     return $response->choices[0]->message->content ?? $text;
    // }
}