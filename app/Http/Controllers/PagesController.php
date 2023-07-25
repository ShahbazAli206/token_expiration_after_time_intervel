<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home($id)
    {
        $pproducts = Services::where('restaurent_id', $id)->with('category', 'colors')->orderBy('created_at', 'desc')->get();
        Log::error(' The pproducts id issssssssssssssssssssss this  ==>  ' . $id);


        return view('pages.home', ['products' => $pproducts]);
    }


    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }



    public function home2()
    {

        $lat1 = Auth::User()->latitude; // Example latitude 1
        $lon1 = Auth::User()->longitude; // Example longitude 1
        $lat2 = 33.731659372450316; // Example latitude 2
        $lon2 = 72.80323139947737; // Example longitude 2
        $unit = "K"; // Example unit of measurement

        $result = $this->distance($lat1, $lon1, $lat2, $lon2, $unit);

        // return "Distance: " . $result . " " . $unit; 
        $users = User::where('role', 3)->get();
        $coordinates = $users->map(function ($user) {
            return [
                'latitude' => $user['latitude'],
                'longitude' => $user['longitude']
            ];
        })->toArray();
        $results = []; // Initialize an empty array

        foreach ($coordinates as $coordinate) {
            $latitude = $coordinate['latitude'];
            $longitude = $coordinate['longitude'];

            // Call your function and store the return value in the array
            $result = $this->distance($lat1, $lon1, $latitude, $longitude, $unit);
            $formattedResult = number_format($result, 1);

            // Append the formatted result to the array
            $results[] = $formattedResult;
            // $results[] = $this->distance($lat1, $lon1, $latitude, $longitude, $unit);
        }
        Log::error(' The userseeeeeeeeee is  ==>  ' . json_encode($users));
        Log::error(' The resultsseeeeeeeeeeeeee is  ==>  ' . json_encode($results));
        $newArray = [];

        for ($i = 0; $i < count($users); $i++) {
            $user = $users[$i];
            $result = $results[$i];

            $user['distance'] = $result;
            $newArray[] = $user;
        }
        Log::error(' The resultsseeeeeeeeeeeeee is  ==>  ' . json_encode($newArray));

        return view('pages.home2', ['products' => $newArray, 'distance' => $results]);
    }

    public function cart()
    {
        // dd(session()->get('cart'));
        return view('pages/cart');
    }
    public function success()
    {
        // dd(session()->get('cart'));
        return view('pages/success');
    }
    public function wishlist()
    {
        $products = Auth::User()->wishlist;
        return view('pages.wishlist', ['products' => $products]);
    }
    public function account()
    {
        $users = User::where('role', 2)->get();

        return view('pages.account', ['prroducts' => $users]);
    }

    public function checkout()
    {

        return view('pages.checkout');
    }

    public function product($id)
    {
        $product = Services::with('category', 'colors')->findOrFail($id);
        return view('pages.product', ['product' => $product]);
    }
    public function home_data()
    {
        $res = Services::with('category', 'colors')->orderBy('created_at', 'desc')->get();
        return response($res);
    }
}
