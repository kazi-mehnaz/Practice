<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_multiple_photo;
use App\Models\Category;
// use App\Models\Contact;

class FrontendController extends Controller
{
    function index(){
      return view('index', [
        'categories' => Category::whereNull('category_id')->get(),
        'products' => Product::all()
      ]);
    }
 
    function shop(){
      return view('shop', [
        'categories' => Category::whereNull('category_id')->get(),
        'products' => Product::all()
      ]);
    }

    function contact(){
      return view('contact');
    }

    function about(){
      return view('about');
    }

    function productdetails($product_id){
      $category_id = Product::find($product_id)->category_id;
      return view('productdetails', [
        'product_info' => Product::find($product_id),
        'related_products' => Product::where('category_id', $category_id)->where('id', '!=', $product_id)->limit(4)->get(),
        'multiple_photos' => Product_multiple_photo::where('product_id', $product_id)->get()
      ]);
    }
}
