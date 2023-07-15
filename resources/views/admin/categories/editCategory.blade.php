@extends('admin.layout')

@section('body')

<div style="display: flex;  margin:20px 100px ;width:800px; ">
    <div class="container p-3 my-3 border" style="background-color: rgba(63, 62, 62, 0.151)">

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

<form method="post">
    @csrf

    <div class="form-group">
   
      <label for="exampleInputEmail1">Edit Category</label>
      <hr>
      <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name='cat' value="{{$cat->name }}" >    
      @if ($errors->has('cat'))
     
      <div class="error" style="color:rgb(211, 69, 69)">*{{ $errors->first('cat') }}</div>
      @endif
    </div> 
    <div style="display:flex;     place-content: space-between;"> 
    <td><button formaction='{{Route('updateCategory',['id'=>$cat->id])}}' type="submit" class="btn btn-primary">Update</button></td>
  </form>

  <form>
  <button formaction="{{'/showCategories'}}" type="submit" class="btn btn-primary">Back To Categories</button>
  </form>
</div> 
</div>
</div>
@endsection
