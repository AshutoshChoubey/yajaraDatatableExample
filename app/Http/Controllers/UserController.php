<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use DataTables;
use App\Http\Requests\UserRegistration;
use Illuminate\Support\Facades\Input;   
use Hash;           
              


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$users = array('name'=>'Sam', 'userid'=>2);
        $userList=User::get();

        return view('userList', ['users'=>$userList]);
    }



    public function usersList(){
        $userList=User::get();
        
        //dd($userList);
        return DataTables::of(collect($userList))
                ->editColumn('name', function($d){    
                    return $d->name;
                })
                ->editColumn('email', function($d){
                    return $d->email;
                })
                ->make(true);

    }
    // public function getUser()
    // {
    //     $userList=User::get();

    //     return view('datatable', ['users'=>$userList]); 
    // }
    public function getUser()
    {
        // return Datatables::of(User::query())->make(true);
        $model = DB::table('users')->where('status','<>' , 2)->orderBy('status', 'DESC');;
        // dd($model);
        return Datatables::of($model)
            ->editColumn('status', function($user)
            {
                
                if($user->status==1)
                {
                    $status='Active';
                }
                else if($user->status==0)
                {
                    $status='Inactive';
                }
                else{
                    $status='Pending';
                }
               return $status;
            })
            // ->setRowClass(function ($user) {
            //     return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            // })
            ->setRowClass('{{ $id % 2 == 0 ? "Success" : "Warning" }}')
            ->make(true);
    }


    public function jqueryValidation()
    {
        return view('jqueryValidation');
    }
    public function registerUser(UserRegistration $request)
    {
        if (Input::file('photo')) {
        $filenameWithExt = $request->file('photo')->getClientOriginalName();
        $file = Input::file('photo');
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);          
        $extension = $request->file('photo')->getClientOriginalExtension();
        $photoName = $filename.'_'.time().'.'.$extension; 
            if (file_exists(public_path('/uploads/photo/',$photoName))) {
                // return public_path('/uploads/photo/',$photoName);
            } else {
                 $file->move(public_path('uploads/photo/'), $photoName);
            } 
        }
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->photo=$photoName;
        if($user->save())
        {
            return 1;
        }



    }
    









}
