<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class InfoUserController extends Controller
{
    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'profile_photo_path' => ['nullable', 'image', 'max:2048'], // add validation rules for profile_image
            'ph_no' => ['required', 'max:20'],
    
            // 'phone'     => ['max:50'],
            // 'location' => ['max:70'],
            // 'about_me'    => ['max:150'],
        ]);
        if($request->get('email') != Auth::user()->email)
        {
            if(env('IS_DEMO') && Auth::user()->id == 1)
            {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
                
            }
            
        }
        else{
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }
        if ($request->hasFile('profile_photo_path')) {
            $path = $request->file('profile_photo_path')->store('public/profile_pics');
            $path = str_replace('public/', '', $path);
        }
        
        
        User::where('id',Auth::user()->id)->update([
            
            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'profile_photo_path' => $path ?? Auth::user()->profile_photo_path,
            'ph_no'    => $attributes['ph_no'],
            // 'phone'     => $attributes['phone'],
            // 'location' => $attributes['location'],
            // 'about_me'    => $attributes["about_me"],
        ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }
}
