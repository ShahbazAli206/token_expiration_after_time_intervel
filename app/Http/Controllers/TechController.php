<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TechController extends Controller
{
    public function technician()
     {
         return view('technician.index');
     }
    
     public function technician_account()
     {
         return view('technician.account');
     }

     public function technician_orders()
     {
         return view('technician.orders');
     }
}
