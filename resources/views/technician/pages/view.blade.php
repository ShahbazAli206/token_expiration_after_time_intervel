@extends('layouts.technician')
@section('content')

<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>View the Orders and change there status to Accept</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
                        <table class="table align-items-center mb-0" id = 'myTable' style="background-color: rgb(65, 54, 147)" >
                            <tbody>
                                <div class="container">
                                    <div class="row mb-5">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Update Order</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{route('technicianpanel.status.update',$order->id)}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row mb-3">
                                  
                                                        <div class="row mb-3">
                                  
                                                          <div class="col-md-6">
                                                              <div class="form-group mb-3">
                                                                  <label for="category_id" style="color: rgb(0, 0, 0); font-size: 22px;">Status</label>
                                                                  <select name="status" id="status" class="form-control style="color: rgb(0, 0, 0); font-size: 18px;" @error('category_id') is-invalid @enderror">
                                                                      <option value="" style="color: rgb(0, 0, 0); font-size: 18px;">Select Option</option>
                                                                      @foreach ($states as $status)
                                                                          <option value="{{$status}}" {{old('category_id') == $status ? 'selected' : ''}} style="color: rgb(0, 0, 0); font-size: 18px;">{{$status}}</option>       
                                                                      @endforeach                               
                                                                  </select>
                                                                  @error('category_id')
                                                                      <span class="invalid-feedback">
                                                                          <strong>{{$message}}</strong>
                                                                      </span>                                   
                                                                  @enderror
                                                                  
                                                              </div> 
                                                          </div>
                                  
                                  
                                  
                                                         <div class="row mb-3">
                                  
                                                          <div class="col-md-6">
                                                                  <label for="description" style="color: rgb(0, 0, 0); font-size: 22px;">Description (note)</label>
                                                                  <textarea name="note" id="note" cols="60" rows="10" class="form-control @error('description') is_invalid @enderror" placeholder="Description about Order status ........" style="color: rgb(0, 0, 0); font-size: 18px;"></textarea>
                                                                  @error('description')
                                                                      <span class="invalid-feedback">
                                                                          <strong>{{$message}}</strong>
                                                                      </span>                                   
                                                                  @enderror                                                             
                                                          </div>
                                                        </div>
                                                        <div class="form-group text-end">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                  
                                    </div>
                                          </div>
                            </tbody>
                        </table>
                    </div>
               
    </div>
</div>
 
@endsection
