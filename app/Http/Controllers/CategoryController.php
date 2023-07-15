<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


    //Show All Categories
    public function showCategories(){
        $user = Auth::user();
        $data = category::all();
        return view('admin.categories.showCategories' , compact('data' , 'user'));
    }

    public function addCategories()
    {
        $user = Auth::user();
        return view('admin.categories.addCategorry', compact('user'));
    }



    //Add New Category
    public function addNewCategory(Request $request)
    {

        $cat = category::where('name', $request->cat)->first();

        if ($cat) {
            return redirect()->back()->with('error', 'This Category Is Exists!');
        } else {
            $catValidation = $request->validate(['cat' => 'required|min:3|max:20']);
            if (!$catValidation) {
                return redirect()->back()->with('success', 'Invalid Category Name');
            } else {
                category::create(['name' => $request->cat]);
                return redirect()->back()->with('success', 'Category Added Successfully');
            }
        }
    }





    //Delete category
    public function deleteCategories($id){
        
        category::find($id)->delete();
        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }





    //edit category
    public function editCategories($id)
    {
        $user = Auth::user();
       $cat = category::find($id);
        return view('admin.categories.editCategory' , compact('user' , 'cat'));
    }

    public function updateCategory(Request $request , $id )
    {

        $cat = category::find($id);
        $cate = category::where('name', $request->cat)->first();

        if ($cate) {
            return redirect()->back()->with('error', 'This Category Is Exists!');
        } else {
            $catValidation = $request->validate(['cat' => 'required|min:3|max:20']);
            if (!$catValidation) {
                return redirect()->back()->with('success', 'Invalid Category Name');
            } else {
                $cat->update(['name'=>$request->cat]);
                return redirect()->back()->with('success', 'Category Updated Successfully');
            }
        }
    }
}
