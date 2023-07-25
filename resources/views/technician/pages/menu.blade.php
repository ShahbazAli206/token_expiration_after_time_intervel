@extends('layouts.technician')
@section('title', 'Edit Profile')
@section('content')
<h1 class="page-title">Edit/Update Menu Items</h1>
<div class="container" >
    <div class="row" >
        <div class="col-12" >
            <div class="card mb-4 mx-4 p-3" style="background-color: rgb(172, 245, 221)">
                <div class="card-header pb-0" style="background-color: rgb(172, 245, 221)">
                    <div class="mb-3 d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0" style="font-size: 24px"> Menu Items</h5>
                        </div>
                        <a href="{{route('technician.create')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp;Add Menu Item</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id = 'myTable'>
                            <thead>
                                <tr>
                                    <th >
                                        Photo
                                    </th>
                                    <th >
                                        Name
                                    </th>
                                    <th >
                                        Price
                                    </th>
                                    <th >
                                        Category
                                    </th>
                                    <th>
                                        Availability Time
                                    </th>
                                    <th >
                                        Creation Date
                                    </th>
                                    <th >
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($prroducts as $product)
                                <tr>
                                    
                                    <td>
                                        <div>
                                            <img src="{{asset('storage/'. $product->image)}}" alt="img N/A" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0"style="color: black;">{{$product->title}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0"style="color: black;">{{$product->price}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0"style="color: black;">
                                            {{$product['category']['name'] ?? 'Not available' }}
                                        </p>
                                    </td>
                                    <td>
                                        @foreach ($product->colors as $color)
                                          <div style="color: black;">{{$color->code}} to {{$color->code1}} </div>
                                        @endforeach
                                    </td>
                                    
                                    <td style="color: black;">{{\Carbon\Carbon::parse($product->created_at)->format('d/m/Y')}}</td>
                                    <td>
                                         <div class="d-flex" style="gap: 5px">
                                            <a href="{{route('technician.eedit',$product->id)}}" class="btn btn-secondary">Edit</a>
                                        <form action="{{route('technician.destroy', $product->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Del</button>                                       
                                        </form>

                                        </div>
                                    </td>
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