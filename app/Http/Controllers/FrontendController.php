<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
// use App\Models\Contact;

class FrontendController extends Controller
{
    function index(){
      return view('index', [
        'categories' => Category::all(),
        'products' => Product::all()
      ]);
    }

    // function createproduct(){
    //   $products = Product::all();
    //   return view('create', compact('products'));
    // }

    // function createproductpost(Request $req){
    //   Product::insert([
    //     'name' => $req->name,
    //     'description' => $req->description,
    //     'count' => $req->count,
    //     'price' => $req->price
    //   ]);
    // return redirect('view')->with('success_message', 'Your product added successfully!');
    // }

    // function view_product(){
    //   $products = Product::latest()->get();
    //   $total_users = Product::count();
    //   return view('view', compact('products', 'total_users'));
    // }

    function contact(){
      return view('contact');
    }

    function about(){
      return view('about');
    }

    function productdetails($product_id){
      return view('productdetails', [
        'product_info' => Product::find($product_id)
      ]);
    }
}
