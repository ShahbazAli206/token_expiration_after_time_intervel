<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CategorySuccess;

class CategoryController extends Controller
{
    //index
    public function index()
    {
        $categories = Category::all();
        return view('laravel-examples/categories.index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name' => 'required|unique:categories|max:255'
        ]);


        //store
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        // $user_ids = \App\Models\User::where('role', 2)->pluck('id')->toArray();
        $users = User::where('role', 3)->pluck('id');
        $user_ids = $users->toArray();
        $user_ids_string = implode(', ', $user_ids); // Convert array to string

        Log::error("\n\n\nThe users id are this  ==> " . $user_ids_string);


        foreach ($user_ids as $user_id) {
            $user = User::find($user_id);
            $user->notify(new CategorySuccess($category->name));
        }


        // User::find(Auth::user()->role)->notify(new CategorySuccess($category->name));


        //return response
        return back()->with('success', 'Category Saved');
    }


    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category Deleted');
    }
}
