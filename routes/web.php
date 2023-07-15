<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//register - login
Route::middleware('auth')->group(function(){
Route::get('redirect',[homecontroller::class , 'redirect'])->name('rdirect');
Route::get('enrolling/{id}',[homecontroller::class , 'enrolling'])->name('enrolling');
Route::delete('deleteEnrolling/{id}',[homecontroller::class , 'deleteEnrolling'])->name('deleteEnrolling');
Route::get('memberEnrollingCourses/{id}' , [homecontroller::class , 'memberEnrollingCourses'])->name('memberEnrollingCourses');
// User logout
Route::get('user.logout',[homecontroller::class , 'logout'])->middleware('auth')->name('user.logout');
Route::post('addComment/{id}' , [ReviewsController::class , 'addComment'])->name('addComment');
});

Route::get('/',[homecontroller::class , 'index'])->name('home');


//home Page -- 
Route::get('allCourses' , [homecontroller::class , 'allCourses'])->name('allCourses');
Route::get('courseDetails/{id}',[homecontroller::class , 'courseDetails'])->name('courseDetails');
Route::get('category/{id}' , [homecontroller::class , 'category'])->name('category');

//Reviews--




// Admin dashboard
Route::middleware('auth' , 'CheckRole')->group(function(){

    //category part ---
    Route::get('addCategories',[CategoryController::class , 'addCategories'])->name('addcategory');
    Route::post('addNewCategory',[CategoryController::class , 'addNewCategory'])->name('AddNewCategory');
    Route::get('showCategories',[CategoryController::class , 'showCategories'])->name('showCategories');
    Route::delete('deleteCategories/{id}',[CategoryController::class , 'deleteCategories'])->name('deleteCategories');
    Route::get('editCategories/{id}',[CategoryController::class , 'editCategories']);
    Route::post('updateCategory/{id}',[CategoryController::class , 'updateCategory'])->name('updateCategory');
    
    //Courses part ---
    Route::get('showCourses',[CourseController::class , 'showCourses']);
    Route::get('addCoursies',[CourseController::class , 'addCoursies'])->name('addcourse');
    Route::post('addNewCourse',[CourseController::class , 'addNewCourse'])->name('AddNewCourse');
    Route::delete('deleteCourse/{id}',[CourseController::class , 'deleteCourse'])->name('deleteCourse');
    Route::delete('forceDeleteCourse/{id}',[CourseController::class , 'forceDeleteCourse'])->name('forceDeleteCourse');
    Route::get('editCourse/{id}',[CourseController::class , 'editCourse']);
    Route::post('updateCourse/{id}',[CourseController::class , 'updateCourse'])->name('updateCourse');
    Route::get('deletedCourses',[CourseController::class , 'deletedCourses'])->name('deletedCourses');
    Route::get('restoreCoursies/{id}',[CourseController::class , 'restoreCoursies'])->name('restoreCoursies');
    Route::get('search',[CourseController::class , 'search'])->name('search');
   
    


     //Instructors part ---
    Route::get('addInstructors',[AdminController::class , 'addInstructors'])->name('addinstructor');
    Route::get('showInstructors',[AdminController::class , 'showInstructors']);
    Route::post('addNewInstructor',[AdminController::class , 'addNewInstructor'])->name('addNewInstructor');
    Route::delete('deleteinstructor/{id}',[AdminController::class , 'deleteinstructor'])->name('deleteinstructor');

     //Admin part ---
    Route::get('showAdmins',[AdminController::class , 'showAdmins']);
    Route::get('addAdmin',[AdminController::class , 'addAdmin'])->name('addadmin');
    Route::post('addNewAdmin',[AdminController::class , 'addNewAdmin'])->name('AddNewAdmin');
    Route::get('deleteAdmin/{id}',[AdminController::class , 'deleteAdmin']);

    Route::get('showMembers',[AdminController::class , 'showMembers'])->name('showMembers');
    Route::delete('deleteMember/{id}',[AdminController::class , 'deleteMember'])->name('deleteMember');
    Route::get('showMemberCourses/{id}',[AdminController::class , 'showMemberCourses'])->name('showMemberCourses');

    

    //Admin logout
    Route::get('logout',[AdminController::class , 'logout'])->name('admin.logout');
});
