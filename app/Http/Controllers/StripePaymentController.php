<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;


class StripePaymentController extends Controller
{


  public function stripe()
  {
    return view('stripe');
  }

  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function stripePost(Request $request)
  {
    Stripe::setApiKey(env('STRIPE_SECRET'));
    Log::error('Cartttttttt' . json_encode($request));
    Log::error('email' . json_encode($request->email));
    Log::error('exp-m' . json_encode($request->exp_m));
    Log::error('name' . json_encode($request->name));




    $customer = Customer::create(array(

      "address" => [

        "line1" => "Virani Chowk",

        "postal_code" => "360001",

        "city" => "Rajkot",

        "state" => "GJ",

        "country" => "IN",

      ],

      "email" => $request->email,

      "name" => $request->name,

      "source" => $request->stripeToken

    ));



    Charge::create([

      "amount" => $request->amount * 100,

      "currency" => "usd",

      "customer" => $customer->id,

      "description" => $request->Description,

      "shipping" => [

        "name" => "Jenny Rosen",

        "address" => [

          "line1" => "510 Townsend St",

          "postal_code" => "98140",

          "city" => "San Francisco",

          "state" => "CA",

          "country" => "US",

        ],

      ]

    ]);
    Session::flash('success', 'Payment successful!');
    return back();
  }
}
