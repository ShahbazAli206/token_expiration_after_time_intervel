<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class resident
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
        if ($user->role == 2) { //resident
            return $next($request);
        }
        if ($user->role == 1) {
            return redirect('/adminpanel');
        }
        if ($user->role == 3) {
            return redirect('/technicianpanel');
        }
        // if($user->role ==4){
        //     return redirect('/staff');

        // }
        // if($user->role ==5){
        //     return redirect('/client');

        // }

    }
}
