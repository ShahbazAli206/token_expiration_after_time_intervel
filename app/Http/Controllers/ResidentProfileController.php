<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ResidentProfileController extends Controller
{
    public function create()
    {
        return view('pages.profile');
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        Log::info('Form data:', $requestData);

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required'],
            'ph_no' => ['max:20'],
            'latitude' => ['required', 'max:20'],
            'longitude' => ['required', 'max:20'],
        ]);
       


        User::where('id', 96)->update([

            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'ph_no'    => $attributes['ph_no'],
            'latitude'    => $attributes['latitude'],
            'longitude'    => $attributes['longitude'],
        ]);


        return redirect('pages/account')->with('success', 'Profile has been updated ');
    }
}
