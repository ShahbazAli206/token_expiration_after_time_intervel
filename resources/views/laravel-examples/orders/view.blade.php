@extends('layouts.user_type.auth')
@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>View the Orders and change there status to Accept</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4 p-3">
                <div class="card-header pb-0">
                    
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0"  style="background-color: rgb(255, 255, 255)" >
                            <tbody>
                                <tr>
                                    <td>Order Id</td>
                                    <td>{{$order->id}}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                    <form action="{{route('orders.view',$order->id)}}" method="post" enctype="multipart/form-data" style="display: flex; gap: 15px; max-width: 300px">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" id=""class="form-control" >
                                                @foreach ($states as $status)
                                                    <option value="{{$status}}" @if($order->status == $status) selected @endif>{{$status}}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-success">Update status</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Total Amount<br> (Approximated Charges)</td>
                                    <td>{{$order->total}}</td>
                                </tr>
                                <tr>
                                    <td>User</td>
                                    <td>{{$order->name}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$order->email}}</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>{{$order->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{$order->country}}</td>
                                </tr>
                                <tr>
                                    <td>State</td>
                                    <td>{{$order->state}}</td>
                                </tr>
                                <tr>
                                    <td>City/td>
                                    <td>{{$order->city}}</td>
                                </tr>
                                <tr>
                                    <td>Zip Code</td>
                                    <td>{{$order->zip}}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{$order->address}}</td>
                                </tr>
                                <tr>
                                    {{-- <td>Stripped</td>
                                    <td>{{$order->strie_id}}</td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection