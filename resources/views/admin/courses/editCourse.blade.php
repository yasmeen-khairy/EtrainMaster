@extends('admin.layout')

@section('body')

<div style="display: flex;  margin:10px auto ;width:600px; ">
    <div class="container p-3 my-3 border" style="background-color: rgba(36, 34, 34, 0.212)">

  @if(session()->has('success'))
  <div class="alert alert-success">
      {{ session()->get('success') }}
  </div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif

<form action='{{'/updateCourse/'.$course->id}}' method="post" enctype="multipart/form-data">
    @csrf
    <h2 style="color:#0090e7;"> Edit Course </h2>
    <hr>

    <div class="mb-3">
      <label for="formFile" class="form-label">Image</label>
      <div class="mb-3"><img style='width: 115px;height:100px;border-radius: 0;' src='{{asset('storage/courses/'.$course->image)}}'></div>
      <input class="form-control" type="file" id="formFile" name='image' value="{{$course->image}}">
      @if ($errors->has('image'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('image') }}</p>
      @endif
    </div>

    <div class="form-group">     
      <label for="exampleInputEmail1">Name</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='name' value="{{$course->name }}" >    
      @if ($errors->has('name'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('name') }}</p>
      @endif
    </div>  
    
    <div class="form-group">     
      <label for="exampleInputEmail1">Description</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='desc' value="{{$course->desc }}" >  
      @if ($errors->has('desc'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('desc') }}</p>
      @endif  
    </div>  

    <div class="form-group"> 
      <label for="exampleInputEmail1">Price</label>
      <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='price' value="{{$course->price }}" > 
      @if ($errors->has('price'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('price') }}</p>
      @endif   
    </div> 


    <div class="form-group">
      <label for="formFile" class="form-label">Course instructor</label>
    <select class="form-select" aria-label="Default select example"
     style="background-color: #2a3038; color:#0090e7;font-family: 'Rubik', sans-serif;font-size: 0.7rem;" 
     name='instructor'>
      <option>{{$users->name}}</option>
      @foreach ($instructor as $item)
      <option>{{$item->user['name']}}</option>
      @endforeach
    </select>
    </div>



    <button type="submit" class="btn btn-primary">Edit</button>
  </form>
</div>
</div>
@endsection