@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" >
                <div class="card-header">{{ __('') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                        
                    @endif
                    <div class="text-primary" style="font-size: 30px">
                        
                    {{__('Your email has been verified')}}
                   {{-- <h1>Your role is {{Auth::user()->role}}</h1> --}}
        
                
                    </div>
                    <br>
                    <button class="btn btn-info"><a href="{{route('technicianpanel')}}" style="color:rgb(19, 39, 147)">Go straight into Portal</a></button>
                    {{-- <a href="{{route('pages/home')}}"></a> --}}
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
