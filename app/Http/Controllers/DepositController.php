<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Deposit;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DepositSuccessful;

class DepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deposit(Request $request)
    {
        $deposit = Deposit::create([
            'user_id' => Auth::user()->id,
            'amount'  => $request->amount
        ]);
        User::find(Auth::user()->id)->notify(new DepositSuccessful($deposit->amount));

        return redirect()->back()->with('status', 'Your deposit was successful!');
    }



    public function markAsRead()
    {
        Log::error('\n\n\n sabh unread all Notifications  ==> ' . json_encode(Auth::user()->unreadNotifications));

        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function markRead(Request $request)
    {
        Log::error('\n\n\n sabh ggggggg  ==> ' . $request->data);
        Log::error('\n\n\n sabh  ==> ' . $request->dataa);

        $id = $request->dataa;
        DB::table('notifications')
            ->where('id', $id)
            ->update(['read_at' => DB::raw('CURRENT_TIMESTAMP')]);
        return redirect()->back();

        // $notification = Notification::findOrFail($notificationId);
        // $notification->markAsRead();
    }
}
