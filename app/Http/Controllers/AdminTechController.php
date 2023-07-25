<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Color;
use App\Models\Category;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminTechController extends Controller
{
    //display Customer table
    public function customer()
    {

        $users = User::where('role', 2)->get();
        Log::error(' The login check log is this  ==>  ' . $users);

        return view('laravel-examples/customer-management', ['prroducts' => $users]);
    }

    //display Restaurents table

    public function index()
    {
        $users = User::where('role', 3)->get();
        Log::error(' The login check log is this  ==>  ' . $users);

        return view('laravel-examples/user-management', ['prroducts' => $users]);
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        return view('laravel-examples/user-create', ['categories' => $categories, 'colors' => $colors]);
    }


    public function store(Request $request)
    {
        //validate
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'colors' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',


        ]);
        //store Image
        $image_name = 'products/' . time() . rand(0, 999) . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('public', $image_name);


        //store
        $product = Services::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'price' => $request->price,   //* 220, for rupee to Dollars
            // 'rating' => $request->rating,   //* 220, for rupee to Dollars
            'description' => $request->description,
            'image' => $image_name
        ]);

        $product->colors()->attach($request->colors);



        //return response

        return back()->with('success', 'Products Saved!');
    }


    public function edit($id)
    {
        $product = Services::findOrFail($id);
        $categories = Category::all();
        $colors = Color::all();
        return view('laravel-examples/user-edit', ['categories' => $categories, 'colors' => $colors, 'asdf' => $product]);
    }


    public function update(Request $request, $id)
    {
        //validate
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'colors' => 'required',
            'price' => 'required',
            // 'rating' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $product = Services::findOrFail($id);
        //store Image
        $image_name = $product->image;
        if ($request->image) {
            $image_name = 'products/' . time() . rand(0, 999) . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public', $image_name);
        }
        //store
        $product->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'price' => $request->price * 100,   //* 220,  for rupee to Dollars
            // 'rating' => $request->rating * 100,   //* 220,  for rupee to Dollars
            'description' => $request->description,
            'image' => $image_name
        ]);
        $product->colors()->sync($request->colors);
        //return response
        return back()->with('success', 'Products Updated!');
    }



    public function destroy($id)
    {
        Log::error(' hhhhhhhheeeeeeeeeee  ');

        Services::findOrFail($id)->delete();
        return back()->with('success', 'Products Deleted');
    }
}
