<?php

namespace App\Http\Controllers;

use App\Models\User;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Message;
use App\Events\SendMessage;
use Illuminate\Http\Request;
use App\Models\PublicContact;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function otp(Request $request)
    {

        $inputtedOTP = $request->otp;
        Log::error(' The inputtedOTP is this  ==>  ' . $inputtedOTP);


        $email = session()->get('email');
        Log::info("session email = " . $email);


        $user = User::where('email', $email)->first();

        if ($user) {
            $otp = $user->otp;
            Log::error(' The DB otp is this  ==>  ' . $otp);

            if ($otp == $inputtedOTP) { // Replace $inputtedOTP with the OTP provided by the user
                $user->email_verified_at = now(); // Assuming you're using Laravel's built-in timestamp column
                $user->save();
                Log::info("verified congrats");

                // Email verified, update the 'email_verified_at' column to the current timestamp
            }
        } else {
            // User with the specified email not found
        }

        session()->flush();
        return redirect('/');
    }

    public function public()
    {
        return view('public');
    }
    public function store(Request $request)
    {
        $PublicContact = new PublicContact;
        $PublicContact->email = $request->get('email');
        $PublicContact->msg = $request->get('msg');
        $PublicContact->save();
        return redirect('/');
    }
    public function read()
    {
        $PublicContact = PublicContact::all();
        return view('publicmsgs')->with(['PublicContact' => $PublicContact]);
    }
    public function delete($id)
    {
        PublicContact::destroy($id);
        return back()->with('success', 'Message Deleted');
    }

    public function home()
    {
        $user = User::find(1);
        $services = DB::table('services')->count();
        $orders = DB::table('orders')->count();
        $categories = DB::table('categories')->count();
        $users = DB::table('users')->where('role', 1)->count();
        return view('dashboard', compact('services', 'orders', 'categories', 'users'));
    }
    public function home2()
    {
        
        $user = User::find(1);
        $services = DB::table('services')->count();
        $orders = DB::table('orders')->count();
        $categories = DB::table('categories')->count();
        $users = DB::table('users')->where('role', 1)->count();
        return view('dashboard', compact('services', 'orders', 'categories', 'users'));    }

    public function chat()
    {
        return view('chat');
    }

    public function messages()
    {
        return Message::with('user')->get();
    }
}
