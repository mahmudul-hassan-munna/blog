<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_File;
use Auth;
use Redirect;

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
        if(Auth::user()->level>1)
        {
            return view('register_user');
        }
        else
        {
            return Redirect::to('/');
        }
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
        if(Auth::user()->level>1)
        {
            $customers=User::where('level',1)->orderBy('id','desc')->get();
            return view('customers',compact('customers'));
        }
        else
        {
            return Redirect::to('/');
        }
        
    }

    public function addFile()
    {
        if(Auth::user()->level==1)
        {
            $customer_files=User_File::where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
            return view('customer_files',compact('customer_files'));
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function saveFile(Request $request)
    {
        if(Auth::user()->level==1)
        {
            $file = $request->file('file');
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());

            $upload_path='uploads/'.$file->getClientOriginalName();

            User_File::create([
                'path' => $upload_path,
                'user_id' => Auth::user()->id
            ]);
            return Redirect::to('/add-file');
        }
        else
        {
            return Redirect::to('/');
        }
    }

}
