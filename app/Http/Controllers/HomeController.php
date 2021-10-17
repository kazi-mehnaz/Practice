<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $select_query = "SELECT * FROM users";
        // $from_db = mysql_query($db_connect, $select_query);
        // print_r($from_db);

        $users = User::latest()->simplePaginate(5);
        // $users = User::orderBy('id', 'desc')->get();
        $total_users = User::count();

        //sent data via compact
        return view('home', compact('users', 'total_users'));
        
        //sent data via array
        // return view('home', [
        //     'users' => $users,
        //     'total_users' => $total_users
        // ]);

        //sent data via with
        // return view('home')->with('users', $users)->with('total_users', $total_users);
    }
}
