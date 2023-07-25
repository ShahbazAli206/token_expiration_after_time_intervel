@extends('layouts.technician')
@section('title', 'Edit Profile')
@section('content')
<div>

    <div class="row">
        <div class="col-12">
            <h1 class="page-title">Add Item</h1>
<div class="container" >
  <div class="row mb-5">
      <div class="col-12">
          <div class="card" style="background-color: rgb(172, 245, 221)">
              <div class="card-header" style="background-color: rgb(172, 245, 221)">
                  <h5>+ New Menu Item</h5>
              </div>
              <div class="card-body">
                  <form action="{{route('technician.sstore')}}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name" style="color: rgb(0, 0, 0); font-size: 18px;">Title</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is_invalid @enderror" value="{{old('title')}}" style="color: rgb(6, 5, 5); font-size: 18px;">
                                @error('title')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="name" style="color: rgb(0, 0, 0); font-size: 18px;">Price</label>
                                <input type="number" name="price" id="price" style="color: rgb(6, 5, 5); font-size: 18px;" class="form-control @error('price') is_invalid @enderror" value="{{old('price')}}">
                                @error('price')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong> 
                                </span>
                                @enderror
                            </div>
                        </div>
                      </div> 
                      <!-- .row  -->

                      <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="category_id" style="color: rgb(0, 0, 0); font-size: 18px;">Category</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" style="color: rgb(6, 5, 5); font-size: 18px;" >
                                    <option value="" style="color: rgb(6, 5, 5); font-size: 18px;" >Select Option</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}} style="color: rgb(6, 5, 5); font-size: 18px;" >{{$category->name}}</option>       
                                    @endforeach                               
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>                                   
                                @enderror
                                
                            </div> 
                        </div>


                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="image" style="color: rgb(0, 0, 0); font-size: 18px;">Image</label>
                                <input type="file" name="image" class="form-control @error('image') is_invalid @enderror" style="color: rgb(6, 5, 5); font-size: 18px;" >
                                @error('image')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>                                   
                                @enderror
                                
                            </div> 
                        </div>

                      </div> 
                       <!-- .row  -->


                       <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="colors" style="color: rgb(0, 0, 0); font-size: 18px;">Timinig</label>
                                @foreach ($colors as $color)
                                     <div class="form-check form-check-inline" >
                                        <input type="checkbox" name="colors[]" class="form-check-input" value="{{$color->id}}" > 
                                        <label for="{{$color->name}}"class="form-check-label" >{{$color->name}}</label>
                                  </div>
                                @endforeach
                                @error('colors')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>                                   
                                @enderror                                                              
                            </div> 
                        </div>
                      </div> 
                       <!-- .row  -->


                       <div class="row mb-3">

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="description" style="color: rgb(0, 0, 0); font-size: 18px;">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is_invalid @enderror" placeholder="Description about technicians ........" style="color: rgb(6, 5, 5); font-size: 18px;" ></textarea>
                                @error('description')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>                                   
                                @enderror                                                             
                            </div> 
                        </div>
                      </div>


                      <div class="form-group text-end">
                          <button type="submit" class="btn btn-primary">Create</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

  </div>
        </div>
    </div>
</div>

@endsection