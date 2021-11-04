<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_multiple_photo;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function addproduct(){
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'), [
            'categories' => Category::all(),
            'products' => Product::all()
        ]);
    }

    function addproductpost(Request $req){

        $product_id = Product::insertGetId([
            'product_name' => $req->product_name,
            'category_id' => $req->category_id,
            'product_price' => $req->product_price,
            'product_quantity' => $req->product_quantity,
            'product_short_description' => $req->product_short_description,
            'product_long_description' => $req->product_long_description,
            'product_thumbnail_photo' => 'Product Thumbnail Photo',
            'created_at' => Carbon::now()
        ]);

        $uploaded_photo = $req->file('product_thumbnail_photo');
        $new_name = $product_id.".".$uploaded_photo->getClientOriginalExtension();
        $new_upload_location = base_path('public/uploads/product_photos/'.$new_name);
        Image::make($uploaded_photo)->resize(600,622)->save($new_upload_location, 40);

        Product::find($product_id)->update([
            'product_thumbnail_photo' => $new_name
        ]);

        $start = 1;
        foreach($req->file('product_multiple_photos') as $product_multiple_photo){
            $uploaded_photo = $product_multiple_photo;
            $new_name = $product_id."-".$start.".".$uploaded_photo->getClientOriginalExtension();
            $new_upload_location = base_path('public/uploads/product_multiple_photos/'.$new_name);
            Image::make($uploaded_photo)->resize(600,550)->save($new_upload_location, 40);
            Product_multiple_photo::insert([
                'product_id' => $product_id,
                'photo_name' => $new_name,
                'created_at' => Carbon::now()
            ]);
            $start++;
        }

        return back();

    }
}
