<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TechProfileController extends Controller
{
    public function create()
    {
        return view('technician.pages.profile');
    }

    public function store(Request $request)
    {


        $requestData = $request->all();

        Log::info('Form data:', $requestData);


        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'profile_photo_path' => ['nullable', 'image', 'max:2048'], // add validation rules for profile_image
            'ph_no' => ['required', 'max:20'],
            'latitude' => ['required', 'max:20'],
            'longitude' => ['required', 'max:20'],
        ]);



        if ($request->get('email') != Auth::user()->email) {
            if (env('IS_DEMO') && Auth::user()->id == 1) {
                return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t change the email address.']);
            }
        } else {
            $attribute = request()->validate([
                'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            ]);
        }
        if ($request->hasFile('profile_photo_path')) {
            $path = $request->file('profile_photo_path')->store('public/profile_pics');
            $path = str_replace('public/', '', $path);
        }

        User::where('id', Auth::user()->id)->update([

            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'profile_photo_path' => $path ?? Auth::user()->profile_photo_path,
            'ph_no'    => $attributes['ph_no'],
            'latitude'    => $attributes['latitude'],
            'longitude'    => $attributes['longitude'],
        ]);


        return redirect('technicianpanel/profile')->with('success', 'Profile has been updated ');
    }
}
