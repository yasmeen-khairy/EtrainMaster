@extends('admin.layout')

@section('body')


@if(count($instructors) == 0)


<div style=" display:flex; flex-direction:column; align-items:center; margin:100px 400px ; ">
  <p style="color: #6c7293;font-size: 1.5rem">No Instructors For Now</p>
  <form>
    @csrf
   
    <td><button formaction="{{'addInstructors'}}" class="btn btn-success">Add New Instructor</button></td>
    
</form>

  </div>
 


 

@else

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

<form>
    @csrf
    <div class="row ">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 >Instructors</h4>
              <hr>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th> Instructor name </th>
                      <th> Email</th>
                      <th> Phone No </th>
                      <th> Courses</th>
                      <th>Specialist</th>
                    
                      <th> Delete </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($instructors as $instructor) 
                    <tr>

                       
                      <td>
                        <img src="{{asset('storage/'.$instructor->user->profile_photo_path)}}" />
                        <span class="ps-2">{{$instructor->user->name}}</span>
                      </td>
                   
                      <td>{{$instructor->user->email}}</td>
                      <td>{{$instructor->phone}} </td>
                     
                      <td>
                        
                         @foreach ($courses as $course)
                         @if($course->instructor_id == $instructor->id)
                        {{$course->name}}<br>
                        @endif
                        @endforeach
                       
                      </td>
                      
                      
                      <td>{{$instructor->spec}}</td>
                    
           
                       <form method="POST" >
                          @csrf
                          @method('delete')
                           <td><button formaction="{{Route('deleteinstructor',['id'=>$instructor->id])}}"  class="btn btn-danger">Delete</button></td>
                       </form>
                     

                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div style="display: flex; place-content: space-between; margin-top:40px ">
                  <form>
                    @csrf
                   
                    <td><button formaction="{{'addInstructors'}}" class="btn btn-success">Add New Instructor</button></td>
                    
                </form>
                {{$instructors->links()}}
                  </div>
              </div>
       
            </div>
      
          </div>
      
        </div>
      </div>
     
</form>

@endif

@endsection