<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //show login page
    public function showLogin()  {  return view('pages/login');   }

    //show register page
    public function showRegister()  {  return view('pages/register');}

    //register user
    public function postRegister(Request $request)
    {
        // Validation
        $request->validate([
            'name'=>'required|min:3|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=>'required|min:8|confirmed', ]);
        

        // Registration
        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),]);

        // Login
        return view('login');
        // Auth::login($user);
        
        // return back()->with('success', 'Successfully Logged IN ! ');
    }

    //Login User
    public function postLogin(Request $request)
    {
        //Validate
        $details = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Login
        if(Auth::attempt($details))
        {  return redirect()->intended('/'); }

        return back()->withErrors([  'email' => 'Invalid Login Details'  ]);
    }

    //Reset Password

    // logout
    public function logout()  {   Auth::logout();   return redirect('/');}
} 
