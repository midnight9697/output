<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $token = $user->createToken('web-app-token')->plainTextToken;
            return response()->json(['auth' => 1, 'message' => 'authenticated', 'bearer' => $token]);
        }
        
        return response()->json(['auth' => 0, 'message' => 'Unauthenticated']);
    
    }

    public function logout( Request $request) {
        auth()->guard('web')->logout();
        return redirect('login');
    }
}
