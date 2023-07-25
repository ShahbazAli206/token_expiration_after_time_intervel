<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Color;
use App\Models\Order;
use App\Models\Category;
// use Illuminate\Notifications\Notification;
use App\Models\Services;
use App\Models\orderconfirm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewOrderPlaced;
use App\Notifications\OrderStatusChanged;
use App\Notifications\TechOrderNotification;
use Illuminate\Support\Facades\Notification;

class TechnicianController extends Controller
{
    public function index()
    {
        $pproducts = Services::where('restaurent_id', Auth::user()->id)->with('category', 'colors')->orderBy('created_at', 'desc')->get();
        Log::error(' The storing data for menu item check is this  ==>  ' . $pproducts);
        return view('technician.pages.menu', ['prroducts' => $pproducts]);
    }

    public function notifications()
    {
        $pproducts = Services::where('restaurent_id', Auth::user()->id)->with('category', 'colors')->orderBy('created_at', 'desc')->get();
        Log::error(' The storing data for menu item check is this  ==>  ' . $pproducts);
        return view('technician.pages.notifications', ['prroducts' => $pproducts]);
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        return view('technician.pages.create', ['categories' => $categories, 'colors' => $colors]);
    }
    public function sstore(Request $request)
    {
        //validate
        Auth::user()->id;
        Log::error(' The storing data for menu item check is this  ==>  ' .  Auth::user()->id);

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'required',
            'colors' => 'required',
            'price' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8048',


        ]);
        //store Image
        Log::error(' The item check 2  ');

        $image_name = 'products/' . time() . rand(0, 999) . '.' . $request->image->getClientOriginalExtension();
        $request->image->storeAs('public', $image_name);


        //store
        $product = Services::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'price' => $request->price,   //* 220, for rupee to Dollars
            'description' => $request->description,
            'image' => $image_name,
            'restaurent_id' => Auth::user()->id,

        ]);
        Log::error(' The storing data is  ==>  ' . $product);

        $product->colors()->attach($request->colors);



        //return response

        return back()->with('success', 'Products Saved!');
    }

    public function edit($id)
    {
        $product = Services::findOrFail($id);
        $categories = Category::all();
        $colors = Color::all();
        return view('technician.pages.edit', ['categories' => $categories, 'colors' => $colors, 'asdf' => $product]);
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
        Services::findOrFail($id)->delete();
        return back()->with('success', 'Products Deleted');
    }







    public function intro()
    {
        return view('technician.pages.introduction');
    }
    public function dashboard()
    {
        $categ_id = auth()->user()->category_id; // Replace with your variable value
        // $order = DB::select('SELECT * from orders WHERE status = ? AND category_id = ?', ['shipped', $categ_id]);


        $orderss = Order::select('orders.id')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->join('services', 'items.service_id', '=', 'services.id')
            ->where('services.restaurent_id', Auth::user()->id)
            ->get();


        $orders = json_decode($orderss, true); // Decode the JSON array

        $orderIds = array_column($orders, 'id'); // Extract the 'id' values from the array

        $result = DB::table('orders')
            ->whereIn('id', $orderIds)
            ->get();
        // $order = DB::select('SELECT o.* FROM orders AS o
        // INNER JOIN items AS i ON o.id = i.order_id
        // WHERE o.status = ? AND i.category_id = ?', ['shipped', $categ_id]);
        Log::error('The filtered orders are is ==> ' . $result);

        return view('technician.pages.dashboard')->with(['order' => $result]);
    }
    public function view($id)
    {
        $states = ['Received', 'Processing', 'On the way', 'Delivered', 'Cancel'];
        $order = Order::with('user', 'items', 'items.services', 'items.color')->findOrFail($id);
        return view('technician.pages.view', ['order' => $order, 'states' => $states]);
    }
    public function store($id, Request $request)
    {
        Order::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', ' Order has been Accepted');
    }

    public function confirmed()
    {
        $orderconfirm = orderconfirm::all();
        return view('technician.pages.confirmed')->with(['orderconfirm' => $orderconfirm]);
    }
    public function updateStatus($id, Request $request)
    {
        $order = Order::find($id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }


        $order->status = $request->input('status');
        $order->note = $request->input('note');
        $order->save();
        Log::error('Cartttttttt' . $order->user_id . "desc" .  $order->note);

        User::find($order->user_id)->notify(new OrderStatusChanged($order->status, $order->note));

        return back()->with('success', 'Order Updated!');
    }

    public function chat()
    {
        return view('technician.pages.chat');
    }
}
