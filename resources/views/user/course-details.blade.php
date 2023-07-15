

@include('front.header')
@include('front.navbar2')

    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>{{$courses->name}}</h2>
                            <p>{{$courses->category->name}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================ Start Course Details Area =================-->
    <section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image">
                        <img class="img-fluid" src="img/single_cource.png" alt="">
                    </div>
                    <div class="content_wrapper">
                        <h4 class="title_top">Objectives</h4>
                        <div class="content">
                            When you enter into any new area of science, you almost always find yourself with a
                            baffling new language of
                            technical terms to learn before you can converse with the experts. This is certainly
                     
                            <br>
                            <br>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore
                            magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi
                            ut aliquip ex ea
                    
                        </div>

                       

                        <h4 class="title">All Courses </h4>
                        <div class="content">
                            <ul class="course_list">
                                @foreach ($allcourses as $course)
                                    
                         
                                <li class="justify-content-between align-items-center d-flex">
                                    <p>{{$course->name}}</p>
                                    <a class="btn_2 text-uppercase" href="{{route('courseDetails' , $course->id)}}">View Details</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

              
                <div class="col-lg-4 right-contents">
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

                    <img src="{{asset('storage/courses/'.$courses->image)}}" >
                    <div class="sidebar_top">
                        <ul>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Trainer’s Name</p>
                                    <span class="color">{{$courses->instructor->user->name}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Course price </p>
                                    <span>{{$courses->price}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Available Seats </p>
                                    <span>{{$courses->seats}}</span>
                                </a>
                            </li>
                            <li>
                                <a class="justify-content-between d-flex" href="#">
                                    <p>Schedule </p>
                                    <span>{{$courses->Schedule}}</span>
                                </a>
                            </li>

                        </ul>
                        
                        @if (Auth::user())
                        @if($courses->seats == 0)
                        <p style="color: blue">sorry this course is completed</p>
                        <a class="btn_2 text-uppercase" href="{{route('memberEnrollingCourses' , $user->id)}}">Show my courses</a>
                        @else
                        <div style="display: flex;  place-content: space-between; ">
                           
                          <a class="btn_2 text-uppercase" href="{{route('enrolling' , $courses->id)}}">Enroll the course</a>
                          <a class="btn_2 text-uppercase" href="{{route('memberEnrollingCourses' , $user->id)}}">Show my courses</a>
                          
                          @endif
                        </div>
                        @else
                        <a class="btn_2 text-uppercase" href="{{route('login')}}">Login to enroll the course</a>
                        @endif
                    </div>

                    <h4 class="title">Reviews</h4>
                    <div class="content">
                        <div class="review-top row pt-40">
                            <div class="col-lg-12">
                            
                                <div class="d-flex flex-row reviews justify-content-between">
                                    <span class="mb-15" >Provide Your Rating</span>
                                    <div class="rating">
                                            <a href="#"><img src="{{asset('img/icon/color_star.svg')}}" alt=""></a>
                                            <a href="#"><img src="{{asset('img/icon/color_star.svg')}}" alt=""></a>
                                            <a href="#"><img src="{{asset('img/icon/color_star.svg')}}" alt=""></a>
                                            <a href="#"><img src="{{asset('img/icon/color_star.svg')}}" alt=""></a>
                                            <a href="#"><img src="{{asset('img/icon/star.svg')}}" alt=""></a>
                                        </div>
                            
                                </div>
                              

                            </div>
                        </div>
                  
                   
                        <form method="POST" action="{{route('addComment' , $courses->id)}}">
                            @csrf
                        <div class="feedeback">
                            <h6>Your Feedback</h6>
                            <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                            <div class="mt-10 text-right">
                                <button type="submit" class="btn btn-success">Send Your Comment</button> 
                            </div>
                        </div>
                        </form>
                        <hr>
                        <div class="comments-area mb-30">
                            @if(session()->has('comment'))
                            <div class="alert alert-success">
                            {{ session()->get('comment') }}
                            </div>
                            @endif
        
                            <h6 class="mb-15" style="color: red">All Comments</h6>
                            <br>

                     
                            @foreach($reviews as $review)
                            <div class="comment-list">
                                <div class="single-comment single-reviews justify-content-between d-flex">
                                    <div class="user justify-content-between d-flex">
                                        <div class="thumb">
                                            <img src="img/cource/cource_1.png" alt="">
                                        </div>
                                        <div class="desc" style="display: flex">
                                            <div>
                                            <span><img style="width:40px" class="img-xs rounded-circle" src="{{asset('storage/'.$review->user->profile_photo_path)}}" /></span>
                                            </div>
                                            <div style="background-color: #bec3c973; padding:9px 20px; border-radius:20px ; margin-left:10px">
                                            <h5>{{$review->user->name}}</h5>
                                            
                                            <p  class="comment">
                                                {{$review->comment}}
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            {{$reviews->Links()}}
           
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Course Details Area =================-->

    <!-- footer part start-->
    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="single-footer-widget footer_1">
                        <a href="index.html"> <img src="img/logo.png" alt=""> </a>
                        <p>But when shot real her. Chamber her one visite removal six
                            sending himself boys scot exquisite existend an </p>
                        <p>But when shot real her hamber her </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Newsletter</h4>
                        <p>Stay updated with our latest trends Seed heaven so said place winged over given forth fruit.
                        </p>
                        <form action="#">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder='Enter email address'
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Enter email address'">
                                    <div class="input-group-append">
                                        <button class="btn btn_1" type="button"><i class="ti-angle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="social_icon">
                            <a href="#"> <i class="ti-facebook"></i> </a>
                            <a href="#"> <i class="ti-twitter-alt"></i> </a>
                            <a href="#"> <i class="ti-instagram"></i> </a>
                            <a href="#"> <i class="ti-skype"></i> </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Contact us</h4>
                        <div class="contact_info">
                            <p><span> Address :</span> Hath of it fly signs bear be one blessed after </p>
                            <p><span> Phone :</span> +2 36 265 (8060)</p>
                            <p><span> Email : </span>info@colorlib.com </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->

    <!-- jquery plugins here-->
    <!-- jquery -->
    <script src="js/jquery-1.12.1.min.js"></script>
    <!-- popper js -->
    <script src="js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- easing js -->
    <script src="js/jquery.magnific-popup.js"></script>
    <!-- swiper js -->
    <script src="js/swiper.min.js"></script>
    <!-- swiper js -->
    <script src="js/masonry.pkgd.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <!-- particles js -->
    <script src="js/owl.carousel.min.js"></script>
    <!-- swiper js -->
    <script src="js/slick.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>