<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    //index
    public function index()
    {
       $colors = Color::all();
        return view('laravel-examples/availibility.index', ['colors'=>$colors]);
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'name'=> 'required|unique:colors|max:255',
            'code'=> 'required',
            'code1'=> 'required'
        ]);


        //store
        $color = new Color();
        $color->name = $request->name;
        $color->code = $request->code;
        $color->code1 = $request->code1;
        $color->save();


        //return response
        return back()->with('success', 'Color Saved');

    }


    public function destroy($id)
    {
        Color::findOrFail($id)->delete();
        return back()->with('success', 'Color Deleted');
     }

}
