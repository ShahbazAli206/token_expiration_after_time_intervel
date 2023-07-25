@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>All Users (Customer) here!</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4 p-3">
                <div class="card-header pb-0">
                    <div class="mb-3 d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Customer</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id = 'myTable'>
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Title
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Contact
                                    </th>
                                   
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prroducts as $product)
                                <tr>
                                    
                                    <td  class="text-center">
                                        <div>
                                            <img src="{{asset('storage/'. $product->profile_photo_path)}}" alt="img N/A" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$product->name}}</p>
                                    </td>
                                    
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$product->ph_no}}</p>
                                    </td>
                                   
                                    <td  class="text-center">{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection