<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('siswa')) {
            return redirect()->route('siswa.login.form')
                           ->with('error', 'Silakan login terlebih dahulu!');
        }

        return $next($request);
    }
}