@extends('layouts.master')
@section('title', 'Checkout')
@section('content')
    <header class="page-header">
        <h1>Checkout</h1>
        <h3 class="cart-amount"></h3>
    </header>
   
    <main class="checkout-page" >
        <div class="container">
            <div class="checkout-form" >
                <form action="{{route('stripeCheckout')}}" id="payment-form" method="post" >
                    @csrf
                    @if (session()->has('cart') && count(session()->get('cart')) > 0)
                    @foreach (session()->get('cart') as $key => $item)
                        
                    <tr>
                       
                        <td>{{ $item['category_id']}}</td>
                        

                    </tr>
                @endforeach
                    @endif

                    <div class="field">
                        <label for="name" style="font-weight: bold; color: black; font-size: 22px;">Name</label>
                        <input type="text" id="name" name="name" class="@error('name') has-error @enderror"  value="{{old('name') ? old('name'): auth()->user()->name--}}"style="font-weight: bold; color: black; font-size: 18px;">
                        @error('name')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="email" style="font-weight: bold; color: black; font-size: 22px ;">Email</label>
                        <input type="email" id="email" name="email" class="@error('email') has-error @enderror" value="{{old('email') ? old('email'): auth()->user()->email}}"style="font-weight: bold; color: black; font-size: 18px;" >
                        @error('email')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="phone" style="font-weight: bold; color: black; font-size: 22px;">Phone</label>
                        <input type="text" id="phone" name="phone" class="@error('phone') has-error @enderror"  value="{{old('phone') ? old('phone'): auth()->user()->phone}}"style="font-weight: bold; color: black; font-size: 18px;">
                        @error('phone')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="country" style="font-weight: bold; color: black; font-size: 22px;">Payment Method</label>
                        <select id="payment" name="payment" style="font-weight: bold; color: black; font-size: 18px;">
                            <option value="" style="font-weight: bold; color: black; font-size: 18px;">--select Country--</option>
                            <option value="Afghanistan" style="font-weight: bold; color: black; font-size: 18px;">Paypal</option>
                            <option selected value="Kashmir" style="font-weight: bold; color: black; font-size: 18px;">Stripe</option>

                        </select>

                        @error('country')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="address"  style="font-weight: bold; color: black; font-size: 22px;">Address</label>
                        <input type="text" id="address" name="address" class="@error('address') has-error @enderror"  value="{{old('address')}}" style="font-weight: bold; color: black; font-size: 18px;">
                        @error('address')
                            <span class="field-error">{{$message}}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="category_id" value="{{ session()->get('cart')[0]['category_id'] }}">
                    <button class="btn btn-primary btn-block"style="font-weight: bold; font-size: 24px; max-width: 100%; max-height: 200px;">Submit order</button>


                </form>
            </div>
        </div>
    </main>



@endsection