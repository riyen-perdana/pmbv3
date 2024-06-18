<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthPeserta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if user is logged in
        $peserta = auth()->guard('peserta')->user();

        //if not, redirect to login page
        if (!$peserta) {
            return redirect('/peserta/login');
        }

        //if user is logged in, continue to next middleware
        return $next($request);
    }
}
