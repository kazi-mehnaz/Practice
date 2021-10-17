<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
// use Auth;
// use Carbon\Carbon;
use App\Models\SubCategory;

class SubcategoryController extends Controller
{
    // public $category_id;

    function addsubcategory(){
        $categories = Category::all();
        // $scategories = SubCategory::all();
        return view('admin.category.subcategory', compact('categories'));
    }

    function addsubcategorypost(Request $req){
        $req->validate([
            'subcategory_name' => 'required|unique:sub_categories,subcategory_name'
        ]);

        SubCategory::insert([
            'subcategory_name' => $req->subcategory_name,
            // 'category_id' => Auth::category()->id,
            // 'created_at' => Carbon::now()
        ]);

        // $category = new Subcategory();
        // $category->category_id = $req->id;
        // $category->subcategory_name = $req->subcategory_name;
        // $category->save();

        return back()->with('success_message', 'Your subcategory added successfully!');
    }
}
