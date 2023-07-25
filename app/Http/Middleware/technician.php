<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class technician
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $user = Auth::user();
        if ($user->role == 3) {
            return $next($request);
        }
        if ($user->role == 1) {
            return redirect('/adminpanel');
        }
        if ($user->role == 2) {
            return redirect('/pages/home2');
        }
    }
}
