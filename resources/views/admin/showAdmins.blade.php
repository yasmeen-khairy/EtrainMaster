@extends('admin.layout')

@section('body')


 

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
              <h4 >Admins</h4>
              <hr>
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th> Admin name </th>
                      <th> Email</th>
                      <th> Delete </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($admins as $admin) 
                    <tr>
  
                      <td>
                        <img src="{{asset('storage/'.$admin->profile_photo_path)}}" />
                        <span class="ps-2">{{$admin->name}}</span>
                      </td>
                      <td>{{$admin->email}}</td>    

                       <form method="Get" >
                          @csrf
                          @if($admin->email == 'yasmeen@gmail.com')
                          <td><button class="btn btn-primary">Super Admin</button></td>
                          @else
                           <td><button formaction="{{'deleteAdmin/'.$admin->id}}"  class="btn btn-danger">Delete</button></td>
                           @endif
                       </form>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div style="display: flex; place-content: space-between; margin-top:40px ">
                    <form method="GET">
                      @csrf
                      <td><button formaction="{{'addAdmin'}}" class="btn btn-success">Add New admin</button></td>       
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
 
</form>



@endsection