
@extends('admin.layout')

@section('body')


 


<div style=" display:flex; flex-direction:column; align-items:center; margin:10px 400px ; ">


  </div>
 

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
              <h4 >{{$memberName->name}} Coursesr</h4>
              <hr>
              <div class="table-responsive">
                <table class="table">
          
                  <tbody>
                    @foreach ($courses as $course)
                    <td>
                      <img style="width: 100px;height:85px;border-radius: 0;" src="{{asset('storage/courses/'.$course->image)}}" />
                        <span class="ps-2">{{$course->name}}</span>
                    </td>
                @endforeach
                  </tbody>
                  <form method="get" >
                    @csrf
                     <td><button formaction="{{Route('showMembers')}}"  class="btn btn-success">Back To Members</button></td>
                 </form>

                </table>
    
              </div>
       
            </div>
      
          </div>
      
        </div>
      </div>
     
</form>

@endsection

