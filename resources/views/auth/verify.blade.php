@extends('layouts.auth')

@section('content')

        <section class="min-vh-100 mb-8">
           
            <div class="container">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                  <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                      <h5>Submit OTP/Verify Account</h5>
                    </div>
                   
                    <div class="card-body">
                        <form method="POST" action="{{ route('otp') }}">
                        @csrf
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="Enter 6 digit otp, sent to your email" name="otp" id="otp" aria-label="otp" aria-describedby="name" value="{{ old('name') }}">
                        </div>
                       
                        
                        
                        <div class="text-center">
                          <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
                            {{ __('Confirm OTP') }}
                        </button>
                        </div>
                      </form>
                    </div>
                  </div>
              </div>
            </div>
          </section>
@endsection
