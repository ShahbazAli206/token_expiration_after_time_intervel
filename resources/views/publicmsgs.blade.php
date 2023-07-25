@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>See all Public Messeges here!</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12" >
            <div class="card mb-4 mx-4 p-3" style="background-color: rgb(172, 245, 221)">
                <div class="card-header pb-0" style="background-color: rgb(172, 245, 221)">
                    <div class="mb-3 d-flex flex-row justify-content-between">
                        <div >
                            <h5 class="mb-0">All msgs</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id = 'myTable'>
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Message
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Delete
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($PublicContact as $item)
                                    <tr>
                                        <td class="ps-4">{{$item->id}}</td>
                                        <td class="text-center">{{$item->email}}</td>
                                        <td class="text-center">{{$item->msg}}</td>
                                        <td><form action="{{route('msgs.delete', $item->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        
                                        </form></td>
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