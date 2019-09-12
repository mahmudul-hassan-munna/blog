<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function registerUser()
    {
        return view('register_user');
    }

    public function userCreate(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
            'password' => bcrypt($request->password),
        ]);

        //Session::flash('Saved successfully');
        return redirect()->route('home');
    }

    public function customers()
    {
        $customers=User::where('level',1)->get();
        return view('customers',compact('customers'));
    }

}
