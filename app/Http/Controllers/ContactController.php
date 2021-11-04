<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Auth;
use Carbon\Carbon;

class ContactController extends Controller
{
     function index(){
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    function contactpost(Request $req){
        // print_r($req->all());
        Contact::insert([
            'name' => $req->name,
            'email' => $req->email,
            'subject' => $req->subject,
            'message' => $req->message,
            'created_at' => Carbon::now()
        ]);
        return redirect('contact')->with('success_message', 'Your response recorded successfully!');
    }
}
