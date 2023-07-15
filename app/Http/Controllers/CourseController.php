<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\category;
use App\Models\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

  
    public function search(request $request){

        $user = Auth::user();
        $courses = course::where('name' , 'like' , '%'.$request->search.'%')->get();
       
        if(count($courses)>0 ){
            return view ('admin.courses.courseSearch' , compact('courses' , 'user'));
        }else{
            return view ('admin.courses.courseSearchNotFound' , compact('courses' , 'user'));
    }
        
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addCoursies()
    {
            $user = Auth::user();
            $categories = category::all();
            $instructors = instructor::all();
            return view('admin.courses.addCourse', compact('user', 'categories', 'instructors'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addNewCourse(Request $request)
    {


        $data = $request->validate([
            'image' => 'required|image',
            'name' => 'required|min:3|max:20',
            'desc' => 'required',
            'price' => 'required|min:1',
            'seats'=>'required|min:1',
            'Schedule'=>'required',
            'category' => 'required',
            'instructor' => 'required'
        ]);

        $category_id = DB::table('categories')->select('id')->where('name', $request->category)->first();
        $user_id = DB::table('users')->select('id')->where('name', $request->instructor)->first();
        $instructor_id = DB::table('instructors')->select('id')->where('user_id', $user_id->id)->first();

        $image = $data['image']->getClientOriginalName();
        Storage::putFileAs('courses', $request->image, $image);

        $CheckCourse = DB::table('courses')->select('*')->where('name', $request->name)->first();
        if ($CheckCourse) {
            return redirect()->back()->with('error', 'Course Is Already Exists');
        } else {
            course::create([
                'image' => $image,
                'name' => $request->name,
                'desc' => $request->desc,
                'price' => $request->price,
                'seats' => $request->seats,
                'Schedule' => $request->Schedule,
                'category_id' => $category_id->id,
                'instructor_id' => $instructor_id->id,

            ]);
            return redirect()->back()->with('success', 'Course Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function showCourses()
    {
        $user = Auth::user();
        $courses = course::paginate(3);
        return view('admin.courses.showCourses' , compact('courses' , 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editCourse(string $id)
    {
        $user = Auth::user();
        $course = course::find($id);
        $instructor = instructor::all();
        $instructors = DB::table('instructors')->select('*')->where('id', $course->instructor_id )->first();
        $users = DB::table('users')->select('*')->where('id', $instructors->user_id )->first();
        return view('admin.courses.editCourse' , compact('course' , 'user' ,'users' , 'instructor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateCourse(Request $request, string $id)
    {
        
        $data = $request->validate([
            'image' => 'required|image',
            'name' => 'required|min:3|max:20',
            'desc' => 'required',
            'price' => 'required|min:1',
            'instructor' => 'required'
        ]);

        $course = course::find($id);
        $user_id = DB::table('users')->select('id')->where('name', $request->instructor)->first();
        $instructor_id = DB::table('instructors')->select('id')->where('user_id', $user_id->id)->first();

        $image = $data['image']->getClientOriginalName();
        Storage::putFileAs('courses', $request->image, $image);


    
            $course->update([
                'image' => $image,
                'name' => $request->name,
                'desc' => $request->desc,
                'price' => $request->price,
                'instructor_id' => $instructor_id->id,

            ]);
            return redirect()->back()->with('success', 'Course Edited Successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteCourse(string $id)
    {
        
            course::find($id)->delete();
            return redirect('showCourses')->with('success', 'Course Deleted Successfully');
        
    }

    
    //Show Deleted Courses ----
     public function deletedCourses()
    {
        $user = Auth::user();
        $courses = course::onlyTrashed()->get();
        return view('admin.courses.deletedCourses' , compact('courses' , 'user'));
    }

    //Restore Deleted Courses ----
    public function restoreCoursies($id){
      
      course::onlyTrashed()->find($id)->restore();
      return redirect()->back()->with('success', 'Course restored Successfully');

    }

    //Force Delete to Courses ----
    public function forceDeleteCourse(string $id)
    {
        
            course::where('id', $id)->forcedelete();
            return redirect()->back()->with('success', 'Course Deleted Successfully');
        
    }

}
