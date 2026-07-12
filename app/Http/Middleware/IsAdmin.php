<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah yang login adalah admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak! Anda bukan Admin.');
        }
        
        return $next($request);
    }
}