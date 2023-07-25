<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\mailController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\AdminTechController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicmailController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\TechProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ResidentProfileController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;

Route::get('/', [HomeController::class, 'public'])->name('public');
Route::post('/', [HomeController::class, 'store'])->name('public.store');
Route::post('/otp', [HomeController::class, 'otp'])->name('otp');
Route::get('/mark-as-read', [DepositController::class, 'markAsRead'])->name('mark-as-read');
Route::post('/mark-read', [DepositController::class, 'markRead'])->name('mark-read');

Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

Auth::routes(['verify' => true]);
// Auth::routes();

Route::get('/home', [App\Http\Controllers\IndexController::class, 'index'])->name('home')->middleware('verified');
Route::get('/login/forgot-password', [ResetController::class, 'create']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendEmail']);
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPass'])->name('password.reset');
Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');


Route::group(['middleware' => 'admin'], function () {
    Route::get('/adminpanel', [HomeController::class, 'home'])->name('adminpanel');
    Route::get('msgs', [HomeController::class, 'read'])->name('msgs');
    Route::delete('msgs/{id}', [HomeController::class, 'delete'])->name('msgs.delete');
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('billing', function () {
        return view('billing');
    })->name('billing');
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');
    Route::get('rtl', function () {
        return view('rtl');
    })->name('rtl');
    Route::get('tables', function () {
        return view('tables');
    })->name('tables');
    Route::get('virtual-reality', function () {
        return view('virtual-reality');
    })->name('virtual-reality');
    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');
    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');
    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('adminpanel.categories');
        Route::post('/', [CategoryController::class, 'store'])->name('adminpanel.category.store');
        Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('adminpanel.category.destroy');
    });

    Route::group(['prefix' => 'availability'], function () {
        Route::get('/', [ColorController::class, 'index'])->name('adminpanel.availability');
        Route::post('/', [ColorController::class, 'store'])->name('adminpanel.availability.store');
        Route::delete('/{id}', [ColorController::class, 'destroy'])->name('adminpanel.availability.destroy');
    });



    Route::group(['prefix' => 'technicians'], function () {
        Route::get('/', [AdminTechController::class, 'index'])->name('adminpanel.technicians');
        Route::get('/create', [AdminTechController::class, 'create'])->name('adminpanel.technicians.create');
        Route::post('/create', [AdminTechController::class, 'store'])->name('adminpanel.technicians.store');
        Route::get('/{id}', [AdminTechController::class, 'edit'])->name('adminpanel.technicians.edit');
        Route::put('/{id}', [AdminTechController::class, 'update'])->name('adminpanel.technicians.edit');
        Route::delete('/{id}', [AdminTechController::class, 'destroy'])->name('adminpanel.technicians.destroy');
    });


    Route::group(['prefix' => 'Customers'], function () {
        Route::get('/', [AdminTechController::class, 'customer'])->name('adminpanel.Customers');
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders');
        Route::get('/{id}', [OrderController::class, 'view'])->name('orders.view');
        Route::put('/{id}', [OrderController::class, 'updateStatus'])->name('orders.view');
    });


    Route::get('mail/contact', [mailController::class, "mailform"])->name('mail.create');
    Route::post('mail/sendemail', [mailController::class, "sendmail"])->name('sendmail');
});


// Resident Portal

    Route::group(['prefix' => 'pages'], function () {
        Route::get('/home/{id}', [PagesController::class, 'home'])->name('home');
        Route::get('/home2', [PagesController::class, 'home2'])->name('home2');
        Route::get('/cart', [PagesController::class, 'cart'])->name('cart');
        Route::get('/wishlist', [PagesController::class, 'wishlist'])->name('wishlist');
        Route::get('/account', [PagesController::class, 'account'])->name('account');
        Route::get('/checkout', [PagesController::class, 'checkout'])->name('checkout');
        Route::get('/success', [PagesController::class, 'success'])->name('success');
        Route::get('/products/{id}', [PagesController::class, 'product'])->name('product');

        Route::post('/stripe-checkout', [CheckoutController::class, 'stripeCheckout'])->name('stripeCheckout');
        Route::group(['middleware' => 'CheckTokenExpiration'], function () {

        Route::get('/profile', [ResidentProfileController::class, 'create'])->name('pages.profile');
        Route::post('/profile', [ResidentProfileController::class, 'store'])->name('pages.profile');
    });


        //Cart
        Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
        Route::post('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
        Route::post('/add-to-wishlist/{id}', [WishlistController::class, 'post'])->name('addToWishlist');
        Route::post('/remove-from-wishlist/{id}', [WishlistController::class, 'remove'])->name('removeFromWishlist');
    });

//technician panel
Route::group(['middleware' => 'technician'], function () {

    Route::group(['prefix' => 'technicianpanel'], function () {
        Route::get('/', [TechnicianController::class, 'dashboard'])->name('technicianpanel');
        Route::get('/introduction', [TechnicianController::class, 'intro'])->name('technicianpanel.introduction');
        Route::get('/technician/pages/view/{id}', [TechnicianController::class, 'view'])->name('technicianpanel.pages.view');
        Route::post('/', [TechnicianController::class, 'store'])->name('technicianpanel.store');


        Route::get('/confirmed', [TechnicianController::class, 'confirmed'])->name('technicianpanel.confirmed');
        Route::put('/{id}', [TechnicianController::class, 'updateStatus'])->name('technicianpanel.status.update');

        Route::get('/profile', [TechProfileController::class, 'create'])->name('technicianpanel.pages.profile');
        Route::post('/profile', [TechProfileController::class, 'store'])->name('technicianpanel.pages.store');
    });
});
Route::group(['middleware' => 'technician'], function () {

    Route::group(['prefix' => 'technicianpanel'], function () {
        Route::get('/', [TechnicianController::class, 'dashboard'])->name('technicianpanel');
        Route::get('/introduction', [TechnicianController::class, 'intro'])->name('technicianpanel.introduction');
        Route::get('/technician/pages/view/{id}', [TechnicianController::class, 'view'])->name('technicianpanel.pages.view');

        Route::post('/', [TechnicianController::class, 'store'])->name('technicianpanel.store');
        Route::get('/confirmed', [TechnicianController::class, 'confirmed'])->name('technicianpanel.confirmed');

        Route::put('/{id}', [TechnicianController::class, 'updateStatus'])->name('technicianpanel.status.update');
        Route::get('/profile', [TechProfileController::class, 'create'])->name('technicianpanel.pages.profile');
        Route::post('/profile', [TechProfileController::class, 'store'])->name('technicianpanel.pages.store');
    });

    Route::group(['prefix' => 'technician'], function () {
        Route::get('/', [TechnicianController::class, 'index'])->name('technician.menu');
        Route::get('/notifications', [TechnicianController::class, 'notifications'])->name('technician.notifications');
        Route::get('/create', [TechnicianController::class, 'create'])->name('technician.create');
        Route::post('/create', [TechnicianController::class, 'sstore'])->name('technician.sstore');
        Route::get('/{id}', [TechnicianController::class, 'edit'])->name('technician.eedit');
        Route::put('/{id}', [TechnicianController::class, 'update'])->name('technician.edit');
        Route::delete('/{id}', [TechnicianController::class, 'destroy'])->name('technician.destroy');
    });
});

Route::get('chat', [App\Http\Controllers\HomeController::class, 'chat'])->name('chat');

Route::get('messages', [App\Http\Controllers\HomeController::class, 'messages'])->name('messages');

Route::post('messages', [App\Http\Controllers\HomeController::class, 'messageStore'])->name('messageStore');
