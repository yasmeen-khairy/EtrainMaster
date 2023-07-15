<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\course;
use App\Models\review;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class ReviewsController extends Controller
{
    public function addComment(Request $request , string $id){
        $user = Auth::user();
        $courses = course::find($id);
        review::create([
            'comment' => $request->feedback , 
            'role'=> 'course' ,
            'course_id'=> $courses->id ,
            'user_id'=> $user->id ,
            'instructor_id' => $courses->instructor->id
    ]);
    return redirect()->back()->with('comment' , 'Thank You For Your Comment');
    }

} 
