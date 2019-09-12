<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_File;
use Auth;

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

    public function addFile()
    {
        $customer_files=User_File::where('user_id',Auth::user()->id)->get();
        return view('customer_files',compact('customer_files'));
    }

}
