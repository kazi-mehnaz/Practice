<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
     // function contact(){
    //   $contacts = Contact::all();
    //   return view('contact', compact('contacts'));
    // }

    function contactpost(Request $req){
        print_r($req->all());
        // Contact::insert([
        //     'name' => $req->name,
        //     'email' => $req->email,
        //     'subject' => $req->subject,
        //     'message' => $req->message
        // ]);
        // return back();
        // return redirect('contact')->with('success_message', 'Your response recorded successfully!');
    }
}
