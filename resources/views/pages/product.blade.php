@extends('layouts.master')
@section('name', '{{$product->title}}')
@section('content')
     @if(session()->has('addedToCart'))
         <section class="pop-up">
            <div class="pop-up-box">
                <div class="pop-up-title">
                {{session()->get('addedToCart')}}
            </div>
            <div class="pop-up-actions">
                {{-- <a href="{{route('home2')}}" class="btn btn-outlined">Browse More servies...</a> --}}
                <a href="{{route('cart')}}" class="btn btn-primary">order confirmation !</a>
            </div>
        </div>
         </section>
     @endif
    <div class="product-page">
        <div class="container">
            <div class="product-page-row">
                <section class="product-page-image">
                    <img src="{{asset('storage/'.$product->image)}}" alt="" style="max-width: 80%; max-height: 350px;">
                </section>
                <section class="product-page-details">
                    <p class="p-title">{{$product->title}}</p>
                    <p style="color: rgb(23, 23, 28); font-size: 22px; font-weight: bold;">Visit Charges:</p>
                    @isset($product->price)
                    <p class="p-price"> {{$product->price}}</p>
                    @endisset    
                    <p style="color: rgb(23, 23, 28); font-size: 22px; font-weight: bold;">Category:</p>
                   
                    @isset($product['category']['name'])
                    <?php $categoryName = $product['category']['name']; ?>
                    <p class="p-category">{{$categoryName}}</p>

                    {{ $categoryName }} <br>
                @endisset
                    <p style="color: rgb(23, 23, 28); font-size: 22px; font-weight: bold;">Description:</p>
                    <p class="p-description"> {{$product->description}}</p>

                    <form action="{{route('addToCart',$product->id)}}" method="post">
                        @csrf
                        <div class="p-form">
                            <div class="p-colors">
                                <label for="color">Availability</label>
                                <select name="color" id="color" required>
                                    <option value="">-- Select Timing --</option>
                                    @foreach ($product->colors as $color)
                                        <option value="{{$color->id}}">{{$color->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="p-quantity">
                                <label for="quantity">No. of Task</label>
                                <input type="number"name="quantity" min="1" max="100" value=1 required>
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label style="color: rgb(23, 23, 28); font-size: 22px; font-weight: bold;" for="description">Description</label>
                                    <textarea name="description" id="description" cols="80" rows="5" class="form-control @error('description') is_invalid @enderror" placeholder="Write Some Description about order ..."></textarea>
                                    @error('description')
                                        <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>                                   
                                    @enderror                                                             
                                </div> 
                            </div>
                          </div> 
                        <button type="submit" class="btn btn-cart"> Order Now</button>
                    </form>

                </section>
            </div>
        </div>
    </div>
@endsection