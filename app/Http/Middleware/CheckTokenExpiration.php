<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

class CheckTokenExpiration
{
    public function handle(Request $request, Closure $next)
    {
        $user = session()->get('Auth_user_data');
        Log::error(" The session user data is   ==> " . json_encode($user));
        $token = $user['token'];
        Log::error(" The token is   ==> " . $token);

        $delimiterPosition = strpos($token, '|');
        
        if ($delimiterPosition !== false) {
            $idd = substr($token, 0, $delimiterPosition);
        } else {
            // Handle the case when the token format is incorrect
            $idd = null;
        }
        Log::error(" The id is   ==> " . $idd);

        // Check if the user is authenticated
     
            $tokenRecord = DB::table('personal_access_tokens')->where('id', $idd)->first();

            $tokenExpiresAt = Carbon::parse($tokenRecord->expires_at);
            Log::error(" The tokenExpiresAt is   ==> " . $tokenExpiresAt);
           
            if ($tokenExpiresAt < now()) {
                // Token has expired, redirect to the login page
                Log::error(" Token has been Expired ");
                return redirect()->back()->withErrors(['msg' => 'Sorry, Your Token has been expired, logout now and again login to proced. ']);

                
                // return redirect('/adminpanel')->withErrors(['token' => 'Token has expired. Please log in again.']);
            }
            else {
                Log::error(" im in if < now condition ");

                return $next($request);
            }
        

    }
}
