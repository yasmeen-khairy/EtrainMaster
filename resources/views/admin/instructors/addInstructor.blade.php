@extends('admin.layout')

@section('body')

<div style="display: flex;  margin:20px 100px ;width:600px; ">
    <div class="container p-3 my-3 border" style="background-color: rgba(63, 62, 62, 0.123)">

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

<form action='{{Route('addNewInstructor')}}' method="post" enctype="multipart/form-data">
    @csrf
    <h2> Add Instructor </h2>
<hr>
    <div class="form-group">
        <select class="form-select" aria-label="Default select example"
         style="background-color: #2a3038; color:#0090e7;font-family: 'Rubik', sans-serif;font-size: 1rem;" 
         name='instructor'>
         <option selected >-- Declear instructor account -- </option>
         @foreach ($users as $item)
      <option>{{$item->email}}</option>
      @endforeach
        </select>
        </div>
    

    
    <div class="form-group">     
      <label for="exampleInputEmail1">Specialist</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='spec' >  
      @if ($errors->has('spec'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('spec') }}</p>
      @endif  
    </div>  

    <div class="form-group"> 
      <label for="exampleInputEmail1">Phone number</label>
      <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='phone' > 
      @if ($errors->has('phone'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('phone') }}</p>
      @endif   
    </div> 



    <button type="submit" name='addInstructor' class="btn btn-primary">Add</button>
  </form>
</div>
</div>
@endsection