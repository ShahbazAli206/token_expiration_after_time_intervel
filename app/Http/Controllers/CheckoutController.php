<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderPlaced;
use App\Notifications\DepositSuccessful;

class CheckoutController extends Controller
{
    public function stripeCheckout(Request $request)
    {
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => 'pending',
        ]);

        foreach (session()->get('cart') as $item) {
            $order->items()->create([
                'service_id' => $item['product']['id'],
                'color_id' => $item['color']['id'],
                'category_id' => $item['category_id'],
                'quantity' => $item['quantity'],

            ]);
            Log::error('Cartttttttt' . json_encode($item));

            Log::error('Cartttttttt' . $item['product']['restaurent_id']);

            User::find($item['product']['restaurent_id'])->notify(new NewOrderPlaced($item['product']['title']));

            User::find(Auth::user()->id)->notify(new DepositSuccessful($order->id));
        }

        session()->forget('cart');

        return view('pages.success', ['order' => $order]);
    }
}
