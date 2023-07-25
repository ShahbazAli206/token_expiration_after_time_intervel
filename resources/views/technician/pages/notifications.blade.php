@extends('layouts.technician')
@section('title', 'Edit Profile')
@section('content')
<h1 class="page-title">Edit/Update Menu Items</h1>
<div class="container" >
    <div class="row" >
        <div class="col-12" >
            <div class="card mb-4 mx-4 p-3" style="background-color: rgb(172, 245, 221)">
                <div class="card-header pb-0" style="background-color: rgb(172, 245, 221)">
                    <div class="mb-3 d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0" style="font-size: 24px"> Notifications</h5>
                        </div>
                        <a href="{{route('mark-as-read')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;Mark All as Read </a>
                    </div>
                </div>
                <ul>
                    <li class="nav-item dropdown">
                        
                    
                                    @foreach (auth()->user()->unreadNotifications as $notification)
            
                                    <form action="{{ route('mark-read', $notification->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="data" value="{{ $notification->data['data'] }}">
                                        <input type="hidden" name="dataa" value="{{ $notification->id}}">
            
                                        <button type="submit" style="color: #cf2222; font-size: 16px; width: auto; border-radius: 5px; background-color: #4CAF50; padding: 5px; margin-bottom: 20px; cursor: pointer;">{{ $notification->data['data'] }}</button>
                                    </form>
                                   
                                    @endforeach
            
            
            
                                    @php
                                        $admin_id_list = [1, 2, 35]; // Manually define the admin IDs
                                    @endphp
                                    @foreach (\App\Models\Notification::where('notifiable_id', 'IN', $admin_id_list)->get() as $notification)
                                        <li>{{ $notification->data['data'] }}</li>
                                    @endforeach
            
            
            
            
                                    @foreach (auth()->user()->readNotifications as $notification)
                                    <li style="color: #171515; font-size: 16px; width: auto; border-radius: 5px; padding: 5px 5px; margin-bottom: 20px;"> {{$notification->data['data']}}</li>
                                    @endforeach
                    </li>
            </div>
        </div>
    </div>
    
</div>


@endsection