@extends('admin.layout')

@section('body')

<div style="display: flex;  margin:10px 100px ;width:800px; ">
    <div class="container p-3 my-3 border" style="background-color: rgba(63, 62, 62, 0.096)">

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

<form action='{{Route('AddNewAdmin')}}' method="post">
  <h3 style="color:#0090e7;">Add Admin</h3>
  <hr>
    @csrf
    <div class="form-group">     
      <label for="exampleInputEmail1">Enter user email</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='admin' >  
      @if ($errors->has('admin'))
      <p style="color:rgb(211, 69, 69)">* {{ $errors->first('admin') }}</p>
      @endif  
    </div>  
        <button type="submit" class="btn btn-primary">Add</button>
      </form>
</div>
</div>
@endsection