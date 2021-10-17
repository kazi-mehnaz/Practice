<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    public $category_id;

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function addcategory(){
        $categories = Category::latest()->get();
        $deleted_categories = Category::onlyTrashed()->get();
        return view('admin.category.index', compact('categories', 'deleted_categories'));
    }

    function addcategorypost(Request $req){
        $req->validate([
            'category_name' => 'required|unique:categories,category_name',
            'category_photo' => 'required|image'
        ],[
            'category_name.required' => 'Category Required',
            'category_photo.required' => 'Category Photo Required',
            'category_name.unique' => 'Category already taken'
        ]);

        // if($this->category_id){
        //     $scategory = new Subcategory();
        //     $scategory->name = $this->name;
        //     $scategory->slug = $this->slug;
        //     $scategory->category_id = $this->category_id;
        //     $scategory->save();

        // }

        $category_id = Category::insertGetId([
            'category_name' => $req->category_name,
            'user_id' => Auth::user()->id,
            'category_photo' => $req->category_photo,
            'created_at' => Carbon::now()
        ]);

        $uploaded_photo = $req->file('category_photo');
        $new_name = $category_id.".".$uploaded_photo->getClientOriginalExtension();
        $new_upload_location = base_path('public/uploads/category_photos/'.$new_name);
        Image::make($uploaded_photo)->resize(600,470)->save($new_upload_location, 40);

        Category::find($category_id)->update([
            'category_photo' => $new_name
        ]);

        return back()->with('success_message', 'Your category added successfully!');
    }

    function updatecategory($category_id){
        $category_name = Category::find($category_id)->category_name;
        $category_photo = Category::find($category_id)->category_photo;
        return view('admin.category.update', compact('category_name', 'category_id', 'category_photo'));
    }

    function updatecategorypost(Request $req){
        if($req->hasFile('new_category_photo')){
            $delete_photo_location = base_path('public/uploads/category_photo/'.Category::find($req->category_id)->category_photo);
            unlink($delete_photo_location);

            $uploaded_photo = $req->file('new_category_photo');
            $new_name = $req->$category_id.".".$uploaded_photo->getClientOriginalExtension();
            $new_upload_location = base_path('public/uploads/category_photo/'.$new_name);
            Image::make($uploaded_photo)->resize(600,470)->save($new_upload_location, 40);

            Category::find($req->category_id)->Update([
                'category_photo' => $new_name
            ]);
        }

        Category::find($req->category_id)->Update([
            'category_name' => $req->category_name
        ]);
        return redirect('add/category')->with('update_status', 'Category updated successfully!');
    }

    function deletecategory($category_id){
        Category::find($category_id)->delete();
        return back()->with('delete_status', 'Category deleted successfully!');
    }

    function restorecategory($category_id){
        Category::withTrashed()->find($category_id)->restore();
        return back()->with('restore_status', 'Category restored successfully!');
    }
    
    function harddeletecategory($category_id){
        Category::onlyTrashed()->find($category_id)->forceDelete();
        return back()->with('forcedelete_status', 'Category force delete successfully!');
    }
}
