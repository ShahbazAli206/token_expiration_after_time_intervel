@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Edit Availability</h1>
<div class="container">
    <div class="row mb-5">
        <div class="col-md-6 offser-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>Create Timing (Availibility)</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('adminpanel.availability.store')}}" method="post"> 
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror 
                        </div>
                        <div class="form-group mb-3">
                            <label for="code">Available From</label>
                            <input type="time" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{old('code')}}">
                            @error('code')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror 
                        </div>
                        <div class="form-group mb-3">
                            <label for="code1">Available To</label>
                            <input type="time" name="code1" id="code1" class="form-control @error('code1') is-invalid @enderror" value="{{old('code1')}}">
                            @error('code1')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror 
                        </div>
                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Availibility</h5>
                </div>
                <div class="card-body">
                    <table class="table table-stripped" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Published</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($colors as $color)
                                
                           
                            <tr>
                                <td>{{$color->id}}</td>
                                <td>{{$color->name}}</td>
                                <td>
                                    <div style="display: flex; align-items:center; gap:10px">
                                    {{$color->code}} <span style="display: inline-block; width:30px; border-radius:50%; height:30px; background: {{$color->code}};"></span>
                                </div>
                                </td>

                                <td>{{$color->code1}}</td>
                                
                                <td>{{\Carbon\Carbon::parse($color->created_at)->format('d/m/Y')}}</td>
                                <td>
                                    <form action="{{route('adminpanel.availability.destroy', $color->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
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
    </div>
</div>
 
@endsection