@extends('layouts.master')
@section('name', 'Home Page')
@section('content')
    <main class="homepage">
        @include('pages.components.home.header ')
        <section class="products-section">
          <div class="container">
            <h1 class="section-title">Available Food Items</h1>
            <div class="products-row">
              @foreach ($products as $product)
                 <x-product-box :product="$product" :restaurent-id="$restaurent_id ?? null"/>
              @endforeach
            </div>
          </div>
        </section>

      
            
    </main>
@endsection