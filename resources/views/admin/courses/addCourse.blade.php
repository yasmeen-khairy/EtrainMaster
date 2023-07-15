@extends('admin.layout')

@section('body')

<div style="display: flex;  margin:10px 100px ;width:600px; ">
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

<form action='{{Route('AddNewCourse')}}' method="post" enctype="multipart/form-data">
    @csrf
    <h3> Add Course </h3>
<hr>

<div class="mb-3">
  <label for="formFile" class="form-label">Image</label>
  <input class="form-control" type="file" id="formFile" name='image'>
  @if ($errors->has('image'))
  <p style="color:rgb(211, 69, 69)">* {{ $errors->first('image') }}</p>
  @endif
</div>

    <div class="form-group">     
      <label for="exampleInputEmail1">Name</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='name' >    
      @if ($errors->has('name'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('name') }}</p>
      @endif
    </div>  
    
    <div class="form-group">     
      <label for="exampleInputEmail1">Description</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='desc' >  
      @if ($errors->has('desc'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('desc') }}</p>
      @endif  
    </div>  

    <div class="form-group"> 
      <label for="exampleInputEmail1">Price</label>
      <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='price' > 
      @if ($errors->has('price'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('price') }}</p>
      @endif   
    </div> 

    <div class="form-group"> 
      <label for="exampleInputEmail1">Available Seats</label>
      <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='seats' > 
      @if ($errors->has('seats'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('seats') }}</p>
      @endif   
    </div> 

    <div class="form-group"> 
      <label for="exampleInputEmail1">Schedule</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='Schedule' > 
      @if ($errors->has('Schedule'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('Schedule') }}</p>
      @endif   
    </div> 


    <div style="display:flex; place-content: space-between;"> 
    <div class="form-group" style="width: 250px">
      <label for="formFile" class="form-label">Course Category</label>
      <select class="form-select" aria-label="Default select example" 
      style="background-color: #2a3038; color:#0090e7;font-family: 'Rubik', sans-serif;font-size: 0.7rem;" 
      name='category'>
        @foreach ($categories as $item)
      <option>{{$item['name']}}</option>
      @endforeach
    </select>
    </div>

    <div class="form-group" style="width: 250px">
      <label for="formFile" class="form-label">Course instructor</label>
    <select class="form-select" aria-label="Default select example"
     style="background-color: #2a3038; color:#0090e7;font-family: 'Rubik', sans-serif;font-size: 0.7rem;" 
     name='instructor'>
      @foreach ($instructors as $item)
      <option>{{$item->user['name']}}</option>
      @endforeach
    </select>
    </div>
    </div>
    

   <hr>
    <button type="submit" name='addCourse' class="btn btn-primary">Add The Course</button>
    
    
  </form>
  <br>
  <form method="GET">
    @csrf

    <td><button  formaction="{{'showCourses'}}" class="btn btn-success">Show All courses</button></td>
    
</form>
</div>
</div>
@endsection