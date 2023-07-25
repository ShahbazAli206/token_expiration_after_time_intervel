{{-- 
@if (Auth::user()->role == '2')
    @extends('layouts.user_type.auth')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <chat :user="{{ Auth::user() }}"/>
                
            </div>
            </div>
        </div>
    </div>
    @endsection
@endif --}}
@if(Auth::user()->role == '3')
    @extends('layouts.app1')
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <chat :user="{{ Auth::user() }}"/>
            </div>
            </div>
        </div>
    </div>
    @endsection
    
@endif
