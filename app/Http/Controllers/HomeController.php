<?php

namespace App\Http\Controllers;


use App\Models\user;
use App\Models\course;
use App\Models\member;
use App\Models\review;
use App\Models\category;
use App\Models\instructor;
use App\Models\course_user;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class homecontroller extends Controller
{


    public function index()
    {

        $user = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
        }
        
        $courses = course::paginate(3);
        $allcourses = course::all();
        $members = member::all();
        $categories = category::all();
        $instructors = instructor::all();
        $members = user::where('role' , 'member')->get();
        return view('user.home', compact('courses', 'user',   'instructors' , 'members' , 'categories' , 'allcourses' , 'members'));
    }




    public function redirect()
    {

        $user = Auth::user();
        $courses = course::paginate(3);
        $instructors = instructor::all();
        $categories = category::all();
        $member_id = DB::table('users')->select('id')->where('role', 'member')->first();

        if (Auth::user()->role == 'admin') {
            $_SESSION['id'] = Auth::user()->id ;
            return view('admin.dashboard', compact('user'));
        }
     
        $_SESSION['id'] = Auth::user()->id ;
      
        return view('user.home', compact('courses', 'user' , 'instructors' , 'categories'));
    }



    public function allCourses(){

        $user = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
        }

        $courses = course::all();
        $categories = category::all();
        return view('user.allCourses', compact('courses', 'user' , 'categories'));
    }

    public function courseDetails( string $id){


        $user = Auth::user();
        if(Auth::user()){
            $_SESSION['id'] = Auth::user()->id ;
        }
        $courses = course::find($id);
        $allcourses = course::all();
        $categories = category::all();
        $reviews = review::where('course_id' , $courses->id)->paginate(5);
     
        return view('user.course-details', compact('courses', 'user' ,'allcourses' ,'reviews' , 'categories'));
    }


public function enrolling($id){

    $user = Auth::user();
    if(Auth::user()){
        $_SESSION['id'] = Auth::user()->id ;
    }
    $courses = course::find($id);
    $old_course = DB::table('course_users')->select('*')->where('user_id', $user->id)->Where('course_id' , $courses->id) ->first();
    $old_member = DB::table('members')->select('*')->where('user_id', $user->id)->first();
    $seats = $courses->seats;
    if(!$old_member){
           member::create(['user_id'=>$user->id]);
    }

       if($old_course){
        return redirect()->back()->with('error' , 'You Have Enrolled In This Course Before');
       }else{
        course_user::create([
            'course_id'=>$courses->id ,
            'user_id'=> $user->id,
        ]);
       
        $courses->update(['seats' => $seats-1]);
        return redirect()->back()->with('success' , 'Course Enrolled Successfully');
       
            }

    
}


public function deleteEnrolling($id){

    $user = Auth::user();
    if(Auth::user()){
        $_SESSION['id'] = Auth::user()->id ;
    }
    $courses = course::find($id);
    $seats = $courses->seats;
    $course_id = DB::table('course_users')->select('*')->where('user_id', $user->id)->Where('course_id' , $id) ->first();
    course_user::find($course_id->id)->forceDelete();
    $courses->update(['seats' => $seats+1]);
    return redirect()->back()->with('success' , 'Course Unenrolling Successfully');

}
public function memberEnrollingCourses($id){

    $user = Auth::user();
    if(Auth::user()){
        $_SESSION['id'] = Auth::user()->id ;
    }
    $allcourses = user::find($user->id)->courses;
    $categories = category::all();

    return view('user.memberEnrollingCourses', compact( 'user' ,'allcourses'  , 'categories'));
}

public function category($id){

    $user = Auth::user();
    if(Auth::user()){
        $_SESSION['id'] = Auth::user()->id ;
    }
    $categories = category::where('id' , $id)->get();
    $courses = course::where('category_id' , $id)->get();
    return view('user.showCourseCategory', compact( 'user' ,'courses'  , 'categories'));
}


    public function logout()
    {
        $categories = category::all();
        $courses = course::paginate(3);
        Session::flush();
        
        Auth::logout();

        return view('user.home' , compact('courses' , 'categories'));
    }

}
