<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Users.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->add_user['id'])) {
            $user= User::find($request->add_user['id']);
        } else {
            $user=new User();
        }
        $user->assignRole($request->add_user['role']);
        $user->name=$request->add_user['name'];
        $user->username=$request->add_user['username'];
        $user->role=$request->add_user['role'];
        $user->status=$request->add_user['status'];
        $user->created_by=Auth::id();
        $user->email=$request->add_user['email'];
        $user->password=Hash::make($request->add_user['password']);
        $user->extra_field_1=$request->add_user['field1'];
        $user->extra_field_2=$request->add_user['field2'];
        $user->extra_field_3=$request->add_user['field3'];
        $user->save();

        $user=Auth::user();
        $user_id=Auth::id();
        if($user->hasRole('Admin')){
            $data = User::where('id', '!=', auth()->user()->id)->get();
        }
        else{
            $data = User::where('created_by', auth()->user()->id)->get();
        }


        return response()->json($data,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user=Auth::user();
        $user_id=Auth::id();
        if($user->hasRole('Admin')){
            $data = User::where('id', '!=', auth()->user()->id)->get();
        }
        else{
            $data = User::where('created_by', auth()->user()->id)->get();
        }


        return response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=User::where('id',$id)->first();
        return response()->json($data,200);
    }

    public function all_users()
    {
        $user=Auth::user();
        if($user->hasRole('Admin')){
            $data = User::where('id', '!=', auth()->user()->id)->get();
        }
        elseif($user->hasRole('Master User')){
            $data = User::where('created_by', auth()->user()->id)->get();
        }

        return response()->json($data,200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();

        $user=Auth::user();
        $user_id=Auth::id();
        if($user->hasRole('Admin')){
            $data = User::where('id', '!=', auth()->user()->id)->get();
        }
        elseif ($user->hasRole('Child User')){
            $data = User::where('created_by', auth()->user()->id)->get();
        }

        return response()->json($data,200);
    }

    public function change_password()
    {
        return view('Users.change_password');
    }
    public function update_password(Request $request)
    {
        $password=$request->password;
        $confirm_password=$request->confirm_password;
        $user_id=$request->user['id'];

        User::where('id',$user_id)->update([
           'password'=>Hash::make($password),
        ]);

        return response()->json('success',200);
    }
}
