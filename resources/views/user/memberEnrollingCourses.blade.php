@include('front.header')
@include('front.navbar')

@if(count($allcourses) == 0)


<div style=" display:flex; flex-direction:column; align-items:center; margin:300px auto ; ">
  <p style="color: #6c7293;font-size: 1.5rem">No Courses For Now</p>
  <form>
    @csrf
    <td><button  formaction="{{route('allCourses')}}" class="btn btn-success">Show all courses to start enrolling</button></td>
  </form>

 
  </div>
  @else

<section class="special_cource padding_top" >
<div style="display: flex; flex-direction:column;  margin:100px auto ;width:900px; ">


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

<div><h3 style="color: #0c2e60;font-family: Poppins, sans-serif; font-size: 26px; font-weight:bold; margin-bottom:30px">All courses you have enrolling</h3></div>
        <table class="table">
           
            <thead>
              <tr>
                <th scope="col">Course name</th>
                <th scope="col">Price</th>

                <th scope="col">Unenroll Course</th>
              </tr>
            </thead>
            <tbody>
          
                @foreach ($allcourses as $courses)
           
              <tr>
                <td>
                  <img style="width: 120px" src="{{asset('storage/courses/'.$courses->image)}}" />
                    <span class="ps-2">{{$courses->name}}</span>
                </td>
                <td>{{$courses->price}}</td>
               
                <td>
                <form method="POST">
                  @csrf
                  @method('DELETE')
                <button class='btn btn-danger' type="submit" formaction="{{route('deleteEnrolling' , $courses->id)}}">Delete</button>
                </form>
              </td>
              </tr>
              @endforeach
            
            </tbody>
            <form method="get">
            <td><button class='btn btn-success' type="submit" formaction="{{route('allCourses')}}">Back To Courses</button></td>
            </form>
          </table>

</div>

    </section>
   
@endif
    @include('front.footer')

    