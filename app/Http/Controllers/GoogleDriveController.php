<?php

namespace App\Http\Controllers;

use Google\Client;
use Google\Service\Drive;
use Illuminate\Http\Request;

class GoogleDriveController extends Controller {
    private function getClient() {
        $client = new Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(Drive::DRIVE);
        $client->setAccessType('offline'); // so you can get refresh token
        $client->setPrompt('select_account consent');
        return $client;
    }

    public function login() {
        $client = $this->getClient();
        $authUrl = $client->createAuthUrl();
        return redirect($authUrl);
    }

    public function callback(Request $request) {
        $client = $this->getClient();
        $client->fetchAccessTokenWithAuthCode($request->code);
        $token = $client->getAccessToken();

        // Save token to database or session for later use
        session(['google_token' => $token]);

        return "Google Drive connected!";
    }
}
