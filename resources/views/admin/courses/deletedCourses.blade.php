@extends('admin.layout')

@section('body')

<div style="display: flex;  margin:60px auto ;width:900px; ">
 



<form>

{{-- success message --}}
@if(session()->has('success'))
  <div class="alert alert-success">
      {{ session()->get('success') }}
  </div>
{{-- error message --}}
@endif
@if(session()->has('error'))
<div class="alert alert-danger">
    {{ session()->get('error') }}
</div>
@endif


    @csrf
    <label for="exampleInputEmail1">All Deleted Courses</label>
    <hr>
    <table class="table table-dark" style="color:white; ">
        <thead>
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Category</th>
            <th scope="col">Instructor</th>
            <th scope="col">Restore</th>
            <th scope="col">Delete</th>

          </tr>
        </thead>
        <tbody>

            @foreach ($courses as $course)

          <tr>
            <td><img style="width: 100px;height:85px;border-radius: 0;" src="{{asset('storage/courses/'.$course->image)}}"></td>
            <td>{{$course->name}}</td>
            <td>{{$course->desc}}</td>
            <td>{{$course->price}}</td>
            <td>{{$course->category->name}}</td>
            <td>{{$course->instructor->user->name}}</td>

            {{-- Restore course --}}
            <form>
             <td><button formaction="{{Route('restoreCoursies' , $course->id)}}" class="btn btn-primary">Restore</button></td>
            </form>

            <form method="POST" >
              @csrf
             @method('DELETE')
              <td><button formaction="{{url('forceDeleteCourse/'.$course->id)}}" class="btn btn-danger">delete</button></td>
          </form>


          </tr>

          @endforeach
      
        </tbody>
      </table>

      <div style="display: flex; place-content: space-between; margin-top:10px"> 
  

      <form method="GET">
        @csrf
        <td><button  formaction="{{'showCourses'}}" class="btn btn-success">Show All Courses</button></td>
      </form>
      

      </div>

</form>
</div>
    
@endsection