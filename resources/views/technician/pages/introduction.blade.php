@extends('layouts.technician')
@section('title', 'confirmed')
@section('content')
<h1 class="page-title">Restaurent Profile</h1>
<div class="container">
    <div class="text-end mb-5">
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Restaurent Profile Picture</h5>
                </div>
                <div class="card-body" style="background-color: rgb(137, 130, 142)">
                    <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" alt="..." class="w-100 border-radius-lg shadow-sm">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>Restaurent Information</h5>
                </div>
                <div class="card-body" style="background-color: rgb(207, 197, 213)">
                    <p style="color: rgb(71, 4, 229); font-weight:bold; font-size:24px ">Name: </p> <p style="color: rgb(0, 0, 0); font-weight:bold; font-size:20px ">{{Auth::user()->name}}</p>
                    <p style="color: rgb(71, 4, 229); font-weight:bold; font-size:24px ">Email: </p><p style="color: rgb(0, 0, 0); font-weight:bold; font-size:20px ">{{Auth::user()->email}}</p>
                    <p style="color: rgb(71, 4, 229); font-weight:bold; font-size:24px ">Phone Number: </p><p style="color: rgb(0, 0, 0); font-weight:bold; font-size:20px ">{{Auth::user()->ph_no}}</p>
                    <p style="color: rgb(71, 4, 229); font-weight:bold; font-size:24px ">Location: </p>
                    <p style="color: rgb(0, 0, 0); font-weight:bold; font-size:20px">Latitude: {{Auth::user()->latitude}} Longitude: {{Auth::user()->latitude}}</p></p>

                    <div class="d-flex mt-2">
                        <a href="{{route('technicianpanel.pages.profile')}}"><button class="btn btn-primary">Edit Profile</button></a>
                    </div>
                    <?php
        $latitude = 33.7544249; // Your latitude value
        $longitude = 72.7451701; // Your longitude value
        ?>
                    <h5 style="color: rgb(71, 4, 229); font-weight:bold; font-size:24px ">Restaurent Location</h5>

              <div style="width: 600px; height: 500px; border: 1px solid #ccc;margin-bottom: 20px;" class="mapouter">
                  <div class="gmap_canvas">
                    <iframe width="900" height="500" id="gmap_canvas" 
                    src="https://maps.google.com/maps?q=<?= $latitude ?>,<?= $longitude ?>&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">
                  </iframe>
                </div>
              </div>
                </div>
                
            </div>
            
        </div>
           
        



    </div>
</div>
@endsection