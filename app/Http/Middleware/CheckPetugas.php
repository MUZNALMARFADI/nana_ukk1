<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPetugas
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('petugas')) {
            return redirect()->route('login.form')->with('error', 'Silakan login terlebih dahulu!');
        }

        return $next($request);
    }
}