<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function loginView(Request $request) {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = \App\Models\User::find(1); 
            // Or if authenticated via Auth::user()
            $user = Auth::user();
            $token = $user->createToken('web-app-token');
            $tokenId = $token->accessToken->id;
            return response()->json(['auth' => 1, 'message' => 'authenticated', 'bearer' => $token->plainTextToken, 'tokenId' => $tokenId]);
        }
        
        return response()->json(['auth' => 0, 'message' => 'Unauthenticated']);
    }

    public function logout( Request $request) {
        auth()->guard('web')->logout();
        DB::table('personal_access_tokens')->where('id', $request->token_id)->delete();
        return redirect('login');
    }

    public function forgotPasswordView() {
        return view('auth.forgot_password');
    }

    public function changePasswordView(Request $request, $selector, $token) {
        $date = date("U");
        $resets = DB::select("SELECT * FROM password_resets WHERE selector = ? AND expires_at >= ?", [$selector,$date]);

        if (count($resets) < 1) {
            DB::delete("DELETE FROM password_resets WHERE email = ?",[$request->email]);
            return redirect()->route('login');
        }

        $resets = $resets[0];
        try {
            $tokenbin = hex2bin($token);
        } catch (\Throwable $th) {
            return redirect()->route('login');
        }
        
        $tokencheck = password_verify($tokenbin, $resets->token);
        if ($tokencheck) {
            return view('auth.change_password', [
                'email' => $resets->email
            ]);
        }
        return redirect()->route('login');
    }
}