<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsPetugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admins')->check()) {
            if (Auth::guard('admins')->user()->level == 'petugas') {
                return $next($request);
            } elseif (Auth::guard('admins')->user()->level == 'admin') {
                return $next($request);
            }
        }
        return redirect()->route('admin.formLogin');
    }
}
