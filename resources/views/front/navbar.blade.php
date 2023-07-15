<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{route('home')}}"> <img src="{{asset('img/logo.png')}}" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{Route('allCourses')}}">Courses</a>
                                </li>
                           
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Course Categories
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($categories as $category)
                                            
                                       
                                        <a class="dropdown-item" href="{{route('category' , $category->id)}}">{{$category->name}}</a>
                                        @endforeach
                                    </div>
                                </li>
              
                  
                                @if(!isset($_SESSION['id']))
                                <li class="d-none d-lg-block">
                                    <a class="btn_1" href="{{route('register')}}">Register Now</a>
                                </li>
                                @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown">
                                      <div class="navbar-profile" >
                                        <img style="width: 50px ; height:50px" class="img-xs rounded-circle" src="{{asset("storage/".$user->profile_photo_path)}}" alt="">
                                        <span style="color: #2e343b;" class="mb-0 d-none d-sm-block navbar-profile-name">{{$user->name}}</span>
                                        
                                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                      </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                      <h6 class="p-3 mb-0">Profile</h6>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                          <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-settings text-success"></i>
                                          </div>
                                        </div>
                                        <form action="{{Route('profile.show')}}" method="get">
                                          @csrf
                                        <div class="preview-item-content">
                                          <button  style="background-color:  #ffffff; border:none; color:white"><p class="preview-subject mb-1">Settings</p></button>
                                        </div>
                                        </form>
                                      </a>
                                      <div class="dropdown-divider"></div>
                                      <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                          <div class="preview-icon bg-dark rounded-circle">
                                            <i class="mdi mdi-logout text-danger"></i>
                                          </div>
                                        </div>
                                        <form action="{{Route('user.logout')}}" method="get">
                                          @csrf
                                        <div class="preview-item-content">
                                          <button name='logout' style="background-color:  #ffffff; border:none; color:white"><p class="preview-subject mb-1">Log out</p></button>
                                        </div>
                                        </form>
                                      </a>
                                      <div class="dropdown-divider"></div>
                                      <p class="p-3 mb-0 text-center">Advanced settings</p>
                                    </div>
                                  </li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->