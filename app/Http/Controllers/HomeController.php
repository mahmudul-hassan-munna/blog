<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_File;
use Auth;
use Redirect;
use Image;

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
            //dd($file->getClientOriginalExtension());
            $destinationPath = 'uploads';
            $extension=$file->getClientOriginalExtension();
            $data = getimagesize($file);

            $width = $data[0];
            if(isset($request->width))
            {
                $width=$request->width;
            }
            $height = $data[1];
            if(isset($request->height))
            {
                $height=$request->height;
            }

            if($extension=='jpg' || $extension=='jpeg' || $extension=='png')
            {
                $upload_path = 'uploads/' . time().'.'.$extension;
                Image::make($file->getRealPath())->resize($width, $height)->save($upload_path);
            }
            else
            {
                $file_name=time().'.'.$extension;
                $file->move($destinationPath,$file_name);
                $upload_path='uploads/'.$file_name;
            }
            

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

    public function deleteFile(Request $request)
    {
        if(Auth::user()->level==1)
        {
            $user_file=User_File::find($request->id);
            unlink($user_file->path);
            $user_file->delete();

            return Redirect::to('/add-file');
        }
        else
        {
            return Redirect::to('/');
        }
    }

}
