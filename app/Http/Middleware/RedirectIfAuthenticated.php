<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        // Cek jika sudah login via session petugas
        if (session()->has('petugas')) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}