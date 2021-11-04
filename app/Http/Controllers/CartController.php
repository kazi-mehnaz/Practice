<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Carbon\Carbon;

class CartController extends Controller
{
    function addtocart(Request $request){
        if(Cart::where('product_id', $request->product_id)->where('ip_address', request()->ip())->exists()){
            Cart::where('product_id', $request->product_id)->where('ip_address', request()->ip())->increment('quantity', $request->quantity);
        }
        else{
            Cart::insert([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'ip_address' => request()->ip(),
                'created_at' => Carbon::now()
            ]);
        }
        return back();
    }

    function cart(){
        return view('cart', [
            'carts' => Cart::where('ip_address', request()->ip())->get()
        ]);
    }

    function cartdelete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    function cartupdate(Request $request){
        foreach ($request->cart_quantity as $cart_id => $cart_updated_quantity){
            Cart::find($cart_id)->update([
                'quantity' => $cart_updated_quantity
            ]);
        }
        return back();
    }
}
