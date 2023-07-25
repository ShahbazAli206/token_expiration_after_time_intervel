<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\sendmail;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Log::error(' The registration form email storing to session is this ==>  ' . json_encode($data['email']));
        session()->put('email', $data['email']);

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $otp = rand(100000, 999999);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $userr = User::where('email', '=', $data['email'])->update(['otp' => $otp]);

        if ($userr) {

            $details = [
                'subject' => 'Testing Application OTP',
                'body' => 'Your OTP is : ' . $otp
            ];
        }
        Mail::to($data['email'])->send(new sendmail($details));


        // Mail::to($data['email'])->send(new TestMail($user));
        // return $user;
        // Mail::to($data['name'])->send(new TestMail($user));
        // return $user;
        // Mail::to($data['role'])->send(new TestMail($user));
        return $user;
        // Mail::to($data['password'])->send(new TestMail($user));
        // return $user;
    }
}
