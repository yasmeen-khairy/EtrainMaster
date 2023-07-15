@extends('admin.layout')

@section('body')


@if(count($courses) == 0)


<div style=" display:flex; flex-direction:column; align-items:center; margin:100px auto ; ">
  <p style="color: #6c7293;font-size: 1.5rem">No Courses For Now</p>
  <form>
    @csrf
    <td><button  formaction="{{'addCoursies'}}" class="btn btn-success">Add New course</button></td>
  </form>
  <br>
  <form method="GET">
    @csrf
    <td><button  formaction="{{Route('deletedCourses')}}" class="btn btn-primary">Show Deleted Courses</button></td>
  </form>
  </div>
 


 

@else
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
    <label for="exampleInputEmail1">All Courses</label>
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
            <th scope="col">Update</th>
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

            {{-- update course --}}
            <form>
             <td><button formaction="{{'editCourse/'.$course->id}}" class="btn btn-primary">Update</button></td>
            </form>

            {{-- delete course --}}
            <form method="POST" >
                @csrf
               @method('DELETE')
                <td><button formaction="{{url('deleteCourse/'.$course->id)}}" class="btn btn-danger">delete</button></td>
            </form>

          </tr>

          @endforeach
      
        </tbody>
      </table>

      <div style="display: flex; place-content: space-between; margin-top:10px"> 
      <form>
        @csrf
        <td><button  formaction="{{'addCoursies'}}" class="btn btn-success">Add New course</button></td>
      </form>

      <form method="GET">
        @csrf
        <td><button  formaction="{{Route('deletedCourses')}}" class="btn btn-success">Show Deleted Courses</button></td>
      </form>

   
   
      </div>
      <div style="margin-top: 20px">
      {{ $courses->links() }}
      </div>
</form>
@endif
</div>
    
@endsection