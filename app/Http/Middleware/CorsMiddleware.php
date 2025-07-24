<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $origin = $request->headers->get('origin');
            $allowedOrigins = [
                'http://127.0.0.1:8000', // Example local IP
                'http://your-allowed-ip.com', // Example domain
                // Add other allowed origins (IPs, domains) here
            ];

            if (in_array($origin, $allowedOrigins)) {
                header("Access-Control-Allow-Origin: $origin");
            }
            header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Authorization");
            return $next($request);
    }
}
