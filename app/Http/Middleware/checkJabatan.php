<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkJabatan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $jabatan): Response
    {
        $user = auth()->user();

        if (!$user || $user->jabatan !== $jabatan) {
            return $next($request);
        }

        return redirect('/login');
    }
}
