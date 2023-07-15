<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\course;
use App\Models\category;
use App\Models\course_user;
use App\Models\instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class AdminController extends Controller
{


    

    //show Instructors page ........
    public function showInstructors(){

        $user = Auth::user();
        $instructors = instructor::paginate(6);
        $courses = course::all();
        return view('admin.instructors.showInstructors', compact('user', 'instructors','courses'));
    }



    //Add New Instructor page ........
    public function addInstructors()
    {
        $user = Auth::user();
        $users = DB::table('users')->select('id', 'email')->where('role', 'member')->get();
        return view('admin.instructors.addInstructor', compact('user', 'users'));
    }


    //Add New Instructor ........
    public function addNewinstructor(Request $request)
    {


        $data = $request->validate([
    
            'spec' => 'required|min:3',
            'phone' => 'required|numeric|min:10',
            'instructor' => 'required'
        ]);

        if($request->instructor == '-- Declear instructor account --'){
            return redirect()->back()->with('error', 'Instructor email is required');
        }

        $instructor_id = DB::table('users')->select('*')->where('email', $request->instructor)->first();

        $CheckUser = DB::table('instructors')->select('*')->where('user_id', $instructor_id->id)->first();
        if ($CheckUser) {
            return redirect()->back()->with('error', 'Instructor Is Already Exists');

        } else {
            $instructor = User::find($instructor_id->id);
            $instructor->update(['role'=>'instructor']);
            instructor::create([
            
                'spec' => $request->spec,
                'phone' => $request->phone,
                'user_id' => $instructor_id->id
            ]);

           
            return redirect()->back()->with('success', 'Instructor Added Successfully');
        }
        
    }

    
     //Delete Instructor ........
    public function deleteinstructor($id)
    {
            $instructor = instructor::find($id);
            $instructor->delete();

            $user = User::find($instructor->user_id);
            $user->update(['role'=>'member']);

            return redirect()->back()->with('success', 'User Deleted Successfully');
        
    }





     //show Admin page ........
     public function showAdmins(){

        $user = Auth::user();
        $admins = DB::table('users')->select('*')->where('role', 'admin')->get();
        return view('admin.showAdmins', compact('user', 'admins'));

    }



    //Add New Admin page ........
    public function addAdmin()
    {
        $user = Auth::user();
        return view('admin.addAdmin', compact('user'));
    }



    public function addNewAdmin(Request $request)
    {
        $data = $request->validate([
            
            'admin' => 'required|email',
           
        ]);

       $admins = User::where('email', $request->admin)->first();
       if($admins && $admins->role == 'admin'){
        return redirect()->back()->with('error', 'User is already admin');
       
       }elseif($admins)
       {
        DB::update('update users set role = ? where email = ?' , ['admin' , $request->admin]);

        return redirect()->back()->with('success', 'Admin Added Successfully');
       }else
       {
        return redirect()->back()->with('error', 'User email not found');
       }
       
    }


     //Delete Admin ........
     public function deleteAdmin($id)
     {
             $admins = User::find($id);
             $admins->update(['role'=>'member']);
 
             return redirect()->back()->with('success', 'User Deleted From Admin Role Successfully');
         
     }



     //show Members page ........
    public function showMembers(){

        $user = Auth::user();
        $members = DB::table('users')->select('*')->where('role', 'member')->paginate(6);


        return view('admin.members.showMembers' ,compact('user', 'members'));
    }

    public function showMemberCourses($id)
    {
        $user = Auth::user();
            $members = User::find($id);
            $courses = User::find($members->id)->courses;
            $memberName = DB::table('users')->select('*')->where('id', $members->id)->first();
   

            return view('admin.members.showMemberCourses' ,compact('courses' , 'user' , 'memberName'));
            // return $id;
        
    }


     //Delete Member ........
    public function deleteMember($id)
    {
            $members = User::find($id);
            $members->delete();

            return redirect()->back()->with('success', 'User Deleted Successfully');
        
    }



    //logout
    public function logout()
    {
    
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }


    

}
