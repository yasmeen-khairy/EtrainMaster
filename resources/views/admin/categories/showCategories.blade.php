@extends('admin.layout')

@section('body')

@if(count($data) == 0)


<div style=" display:flex; flex-direction:column; align-items:center; margin:100px 400px ; ">
  <p style="color: #6c7293;font-size: 1.5rem">No Categories For Now</p>
  <form>
    @csrf

 <button style="margin-top: 10px" formaction="{{'addCategories'}}" class="btn btn-success">Add New Category</button></td>
  
  </form>
  </div>
 


 

@else

<div style="display: flex;  margin:20px 100px ;width:900px; ">
    <div class="container p-2 my-3 border" style="background-color: rgba(51, 49, 49, 0.11)">

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

<form action=''>
  <label for="exampleInputEmail1">All Categories</label>
  <hr>
    @csrf

    <table class="table table-dark" style="color:white; ">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $cat)
          <tr>
            <td>{{$cat->id}}</td>
            <td>{{$cat->name}}</td>
            <form>
             <td><button formaction="{{'editCategories/'.$cat->id}}" class="btn btn-primary">Update</button></td>
            </form>

            <form method="POST" >
                @csrf
               @method('DELETE')
                <td><button formaction="{{'deleteCategories/'.$cat->id}}" class="btn btn-danger">delete</button></td>
            </form>
            
          </tr>
          @endforeach
      
        </tbody>
   
      </table>
      
      <form>
        @csrf
    <footer>
        <td ><button style="margin-top: 10px" formaction="{{'addCategories'}}" class="btn btn-success">Add New Category</button>
        </footer>
    </form>
    
</form>

    </div>
</div>
@endif
@endsection