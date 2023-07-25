<?php

namespace App\Http\Controllers\Auth;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{


    use AuthenticatesUsers;


    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function login(Request $request)
    {
        Log::error(' \n\n The Login Form data is   ==> email:  ' . $request->email . " password is : " . $request->password);
       
        // $credentials = $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // if (Auth::attempt(($credentials))) {
        //     $user_role = Auth::user()->role;

        //     switch ($user_role) {
        //         case 1:
        //             return redirect('/pages/home2');
        //             break;

        //         case 2:
        //             return redirect('/adminpanel');
        //             break;
        //         case 3:
        //             return redirect('/technicianpanel');
        //             break;
        //         default:
        //             Auth::logout();
        //             return redirect('/login')->with('error', 'invalid role');
        //     }
        // } else {
        //     return redirect('/login')->with('error', 'invalid credentials ( email/password)');
        // }
        try {
            $data1 = [ 'email'=> $request->email, 'password'=> $request->password, 'device_name'=>'mytoken206' ];
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://127.0.0.1:9000/api/sanctum/token",// your preferred url
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data1),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            
            $response = curl_exec($curl);
            $responseData = json_decode($response, true); // Decode the JSON response into an associative array
            $err = curl_error($curl);
            curl_close($curl);
            
            if ($err) {
                Log::error(' The user_role is  ==>  ' . $err);
                return redirect('/login')->with('error', 'invalid credentials ( Curl Error)');
            } elseif (!$responseData) {
                Log::info('HTTP responseData ^^^^^^^^^^^^^^^^^^ :' . json_encode($responseData, JSON_UNESCAPED_SLASHES));
                return redirect('/login')->with('error', 'invalid credentials ( responseData Error)');
            }
            else {
                Log::info('HTTP Response updated ***@@ :' . json_encode($responseData, JSON_UNESCAPED_SLASHES));

                
                session()->put('Auth_user_data', [
                    'id' => $responseData['user']['id'],
                    'name' => $responseData['user']['name'],
                    'email' => $responseData['user']['email'],
                    'token' => $responseData['token']

                ]);
                   
                    return redirect('/pages/account');
                
                
            }
            // $credentials = $request->validate([
            //     'email' => 'required|email',
            //     'password' => 'required'
            // ]);
    
            // if (Auth::attempt(($credentials))) {
            //     $user_role = Auth::user()->role;
            //     Log::error(' The user_role is  ==>  ' . $user_role);
            //     switch ($user_role) {
            //         case 1:
            //             return redirect('/pages/home2');
            //             break;
    
            //         case 2:
            //             return redirect('/adminpanel');
            //             break;
            //         case 3:
            //             return redirect('/technicianpanel');
            //             break;
            //         default:
            //             Auth::logout();
            //             return redirect('/login')->with('error', 'invalid role');
            //     }
            // }else {
            //     return redirect('/login')->with('error', 'invalid credentials ( email/password)');
            // }

        }
        catch (Exception $e) {
            Log::error(' The error in catch is  ==>  ' . $e);
            return redirect('/login')->with('error', 'invalid credentials ( Curl Catch Error)');
        }
    }
}
