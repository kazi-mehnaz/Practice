<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    function index(){
        return view('admin.profile.index');
    }
    function profilepost(Request $req){
        // $req->validate([
        //     'name' => 'required'
        // ]);
        $old_name = Auth::user()->name;
        User::find(Auth::id())->update([
            'name' => $req->name
        ]);
        // echo Auth::user()->id;
        return back()->with('success_message', 'Your Name Updated from '.$old_name.' to'.$req->name);
    }
    function passwordpost(Request $req){
        $req->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($req->old_password == $req->password){
            return back()->withErrors("Your new password can not be your old password!");
        }
        $old_password_from_user = $req->old_password;
        echo $password_from_user_db = Auth::user()->password;
        if(Hash::check($old_password_from_user, $password_from_user_db)){
            User::find(Auth::id())->update([
                'password' => Hash::make($req->password)
            ]);
        }
        else{
            return back()->withErrors("Your old password does not match!");
        }
        return back()->with('password_change', 'Password changed!');
    }
}
