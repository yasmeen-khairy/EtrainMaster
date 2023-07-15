@extends('admin.layout')

@section('body')

<div style="display: flex;  margin:20px 100px ;width:800px; ">
    <div class="container p-3 my-3 border" style="background-color: rgba(63, 62, 62, 0.199)">

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

<form action='{{Route('AddNewCategory')}}' method="post">
    @csrf

    <div class="form-group">
   
      <label for="exampleInputEmail1">Add Category</label>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='cat' >    
      @if ($errors->has('cat'))
      <p style="color:rgb(211, 69, 69)">* The category field is required and must be greater than 2 characters</p>
      @endif
    </div> 
    <div style="display:flex;     place-content: space-between;"> 
    <td><button type="submit" name='addCategory' class="btn btn-primary">Add</button></td>
  </form>

  <form>
  <button formaction="{{'showCategories'}}" type="submit" class="btn btn-primary">Show All Categories</button>
  </form>
</div> 
</div>
</div>
@endsection