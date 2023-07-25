@extends('layouts.master')
@section('name', 'Account Page')
@section('content')
    <div class="account-page">
        <div class="container">
            <form action="{{ route('pages.profile') }}" method="post" role="form text-left" enctype="multipart/form-data"  style="background-color: rgb(177, 161, 189)">
                @csrf
            <div class="card-body" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                            <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                <input class="form-control"  style=" color: rgb(1, 0, 0); font-size: 16px;" type="text" placeholder="Name" id="user-name" name="name">
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" style=" color: rgb(1, 0, 0); font-size: 16px;" type="email" placeholder="@example.com" id="email" name="email">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Phone Number') }}</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" style=" color: rgb(1, 0, 0); font-size: 16px;" type="text" placeholder="03000000000" id="user-ph_no" name="ph_no">
                                    @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <h4 style="color: rgb(0, 0, 0)">Location</h4>
                    <input style="color: rgb(209, 32, 32)" type="text" name="latitude" id="latitude" value="">
                    <input style="color: rgb(209, 32, 32)" type="text" name="longitude" id="longitude" value="">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="@error('longitude')border border-danger rounded-3 @enderror">
                            </div>
                            <div class="d-flex justify-content">
                                <button type="button" onclick="getLocation()" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Get Location' }}</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label for="user.phone" class="form-control-label">{{ __('Profile Image') }}</label>
                    <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                        <input name="profile_photo_path" class="form-control" type="file" placeholder="upload your picture here" id="image">
                            @error('phone')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                    </div>
                    
                    <div class="d-flex justify-content">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
            </div>

        </form>
          
          <script>
        
          function getLocation() {
            if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
            } else {
              x.innerHTML = "Geolocation is not supported by this browser.";
            }
          }
          
          function showPosition(position) {
            document.getElementById("latitude").value = position.coords.latitude;
            document.getElementById("longitude").value = position.coords.longitude;
            latitudeInput.value = position.coords.latitude;
          }
          </script>

        </div>
    </div>
@endsection