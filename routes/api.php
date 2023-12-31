<?php

use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\WishlistController;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/sanctumm', function (Request $request) {

    Log::error('Error saving data to the database');
    $response = 'dfjsdklfjdslfjk';
    return response($response, 201);
});



Route::post('/sanctum/token', function (Request $request) {
    

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);
    Log::info('   validated ********  ok for email : ' .  $request->email .' password : '. $request->password );

    $user = User::where('email', $request->email)->first();
    Log::info('databse data is =====>> '.  json_encode($user));

    $hashpass  = Hash::check($request->password, $user->password);
    Log::info('hashpass data is =====>> '.  json_encode($hashpass));
  
    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    Log::info('im here sirrrr  ');

    $token = $user->createToken($request->device_name, ['expires_in' => 5 ],  ['role' => 'admin'])->plainTextToken;
    Log::info('token is =====>> '.  json_encode($token));

    $response = [
        'user' => $user,
        'token' => $token,
    ];
    Log::info('According to your credentials, this is the data im sending in response =====>> '.  json_encode($response));
$ddd = (json_encode($response));
return response()->json([
        'user' => $user,
        'token' => $token,
]);
});

Route::get(
    '/home_data',
    [PagesController::class, 'home_data']
);

Route::get('/tables/{table}', function ($table) {
    $data = DB::table($table)->get();
    return response()->json(['data' => $data]);
});

Route::get('/users/{userId}/wishlists', function ($userId) {
    $wishlistProducts = DB::table('wishlists')
        ->join('services', 'wishlists.services_id', '=', 'services.id')
        ->join('categories', 'services.category_id', '=', 'categories.id')
        ->where('wishlists.user_id', $userId)
        ->select('services.*', 'categories.name as category_name')
        ->get();
    return response()->json(['data' => $wishlistProducts]);
});

Route::get('/order_status/{userId}', function ($userId) {
    $orders = DB::table('orders')->where('user_id', $userId)->get();
    $data = [];
    foreach ($orders as $order) {
        $items = DB::table('items')
            ->where('order_id', $order->id)
            ->get();

        foreach ($items as $item) {
            $service = DB::table('services')
                ->where('id', $item->service_id)
                ->first();

            $color = DB::table('colors')
                ->where('id', $item->color_id)
                ->first();

            $data[] = [
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'status' => $order->status,
                'service' => $service,
                'color' => $color,
                'quantity' => $item->quantity,
            ];
        }
    }
    return response()->json($data);
});

Route::get('/tech_orders/{id}', function ($id) {
    $cat_ord = DB::table('items')->where('category_id', $id)->get();

    Log::error(' The technicina is is ==>  ' . $id);
    Log::error(' The lis of orders categroy based are  ==>  ' . $cat_ord);
    $data = [];

    foreach ($cat_ord as $item) {
        $order = DB::table('orders')
            ->where('id', $item->order_id)
            ->where('status', 'shipped')
            ->first();
        if ($order !== null) { {
                $data[] = [
                    'order_id' => $order->id,
                    'address' => $order->address,
                    'status' => $order->status,
                    'job' => $item->quantity,
                ];
            }
        }
    }
    Log::error(' The response is ready as  ==>  ' . json_encode($data));

    return response()->json($data);
});

Route::post('/wishlist_add', function (Request $request) {
    $validateData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'service_id' => 'required|exists:services,id',

    ]);
    $wishlist = new Wishlist;
    $wishlist->user_id = $validateData['user_id'];
    $wishlist->services_id = $validateData['service_id'];
    $wishlist->save();
    return response()->json(['message' => 'product is successfully added to wishlist']);
});

Route::post('/cart_add', function (Request $request) {
    // dd($request->all());
    Log::error('Error saving data to the database');

    $validateData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'quantity' => 'required',
        'service_id' => 'required',
        'colors_id' => 'required',
    ]);

    // Prepare the SQL statement to insert the order data
    $sql = "INSERT INTO orders (user_id, name, email, phone, address, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, now(), now())";
    $params = [
        $validateData['user_id'],
        $validateData['name'],
        $validateData['email'],
        $validateData['phone'],
        $validateData['address'],
    ];

    // Execute the SQL statement to insert the order data and get the inserted order ID
    $orderId = DB::table('orders')->insertGetId([
        'user_id' =>  $validateData['user_id'],
        'name' => $validateData['name'],
        'address' => $validateData['address'],
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // Prepare the SQL statement to insert the order item data
    $sql = "INSERT INTO items (order_id, service_id, color_id, quantity, created_at, updated_at)
            VALUES (?, ?, ?, ?, now(), now())";
    $params = [
        $orderId,
        $validateData['service_id'],
        $validateData['colors_id'],
        $validateData['quantity'],
    ];

    // Execute the SQL statement to insert the order item data
    DB::insert($sql, $params);
    $response = [
        'message' => 'Order placed successfully',
        'order_id' => $orderId
    ];

    Log::error('Error saving data to the database' . $orderId);

    return response()->json($response);
});

Route::get('/item_present/{serviceId}/{userid}', function ($serviceId, $userid) {
    $is_present = DB::table('wishlists')
        ->where('services_id', $serviceId)
        ->where('user_id', $userid)
        ->exists();
    Log::error(" service id is =>" . $is_present);

    return response()->json(['is_present' => $is_present]);
});

Route::delete('/wishlist_remove/{user_id}/{id}', function ($user_id, $id) {
    DB::table('wishlists')->where('user_id', $user_id)->where('services_id', $id)->delete();
    Log::error(response());
    return response()->json(['success' => true]);
});

Route::put('/orders/{id}', function ($id) {
    $order = DB::table('orders')->where('id', $id)->first();

    if (!$order) {
        return response()->json(['error' => 'Order not found'], 404);
    }
    $data = request()->all();
    DB::table('orders')->where('id', $id)->update($data);
    return response()->json(['message' => 'Order updated successfully']);
});

Route::put('/orders/{id}/status', function ($id) {
    $order = Order::find($id);

    if (!$order) {
        return response()->json(['message' => 'Order not found'], 404);
    }

    $order->status = 'accept';
    $order->save();

    return response()->json(['message' => 'Order status updated successfully']);
});

Route::get('/orders', function () {
    $orders = DB::table('orders')
        ->orderByDesc('updated_at')
        ->get();
    return response()->json($orders);
});

Route::put('/order_update/{orderId}', function ($orderId) {
    $order = Order::find($orderId);
    $updatedColumns = request()->all();
    $order->update($updatedColumns);
    return response()->json(['message' => 'Order updated successfully.']);
});

Route::get('/categories', function () {
    $categories = DB::table('categories')
        ->get();
    return response()->json($categories);
});

Route::put('/category_update/{orderId}', function ($categoryId) {
    $category = Category::find($categoryId);
    $updatedColumns = request()->all();
    $category->update($updatedColumns);

    return response()->json(['message' => 'Order updated successfully.']);
});

Route::post('/category_add', function (Request $request) {
    $category = new Category;
    $category->name = $request->name;
    $category->save();
    return response()->json(['message' => 'Category created successfully']);
});
