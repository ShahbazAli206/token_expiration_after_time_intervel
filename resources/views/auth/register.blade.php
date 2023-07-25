@extends('layouts.user_type.guest')

@section('content')

  <section class="min-vh-100 mb-8"  style="background-color:aquamarine">
    <div class="page-header align-items-start min-vh-50 pt-5 pb-11 mx-3 border-radius-lg" style="background-image: url('../assets/img/curved-images/module0.png');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Welcome!</h1>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                  <input type="text" class="form-control" placeholder="Name" name="name" id="name" aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                  @error('name')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                    @error('password')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end"></label>

                    <div class="col-md-6">
                    </div>
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirm-Password" name="password_confirmation" required autocomplete="new-password">
                </div>

                {{-- <div class="mb-3">
                  <input type="text" class="form-control" placeholder="role" name="role" id="role" aria-label="role" aria-describedby="role" value="{{ old('role') }}">
                  @error('role')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror
                </div> --}}
                <select name="role" id="role" class="form-control style="color: rgb(0, 0, 0); font-size: 18px;" @error('category_id') is-invalid @enderror">
                  <option value="0" style="color: rgb(0, 0, 0); font-size: 18px;">Select Your Role</option>
                  <option value="1"style="color: rgb(0, 0, 0); font-size: 18px;">admin</option>
                  <option value="3" style="color: rgb(0, 0, 0); font-size: 18px;">restaurent</option>
                  <option value="2"style="color: rgb(0, 0, 0); font-size: 18px;">customer</option>
                      @error('role')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                  @enderror                               
              </select>
 
              
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">
                    {{ __('Register') }}
                </button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="login" class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

