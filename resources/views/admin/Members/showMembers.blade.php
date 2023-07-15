@extends('admin.layout')

@section('body')


 
@if(count($members) == 0)


<div style=" display:flex; flex-direction:column; align-items:center; margin:100px 400px ; ">
  <p style="color: #6c7293;font-size: 1.5rem">No Members For Now</p>

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
              <h4 >members</h4>
              <hr>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th> member name </th>
                      <th> Email</th>
 
                      <th> Courses</th>

                    
                      <th> Delete </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($members as $member) 
                    <tr>

                       
                      <td>
                        <img src="{{asset('storage/'.$member->profile_photo_path)}}" />
                        <span class="ps-2">{{$member->name}}</span>
                      </td>
                   
                      <td>{{$member->email}}</td>


                        <form method="get" >
                          @csrf
                           <td><button formaction="{{Route('showMemberCourses',['id'=>$member->id])}}"  class="btn btn-primary">courses</button></td>
                       </form>
 
                       <form method="POST" >
                          @csrf
                          @method('delete')
                           <td><button formaction="{{Route('deleteMember',['id'=>$member->id])}}"  class="btn btn-danger">Delete</button></td>
                       </form>
                    

                    </tr>
                    @endforeach
                  </tbody>
                </table>
    
              </div>
       
            </div>
      
          </div>
      
        </div>
      </div>
     
</form>
@endif
@endsection

