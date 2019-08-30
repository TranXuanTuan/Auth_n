<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getList()
    {
        $users = User::all();
    	return view('admin.users.list',['users'=>$users]);	
    }

    public function getAdd()
    {
    	return view('admin.users.add');		
    }

    public function postAdd(Request $request)
    {
        $this ->validate($request,
        [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
            'password_confirmation' => 'min:8|same:password'
        ]);

        $user = User::create($request->only('email', 'name', 'password','password_confirmation'));

        return redirect('admin/users/add')
            ->with('flash_message',
             'User successfully added.');
    }
    public function getEdit($id)
    {
        $user = User::findorFail($id);
    	return view('admin/users/edit',['user'=>$user]);		
    }

    public function postEdit(Request $request,$id)
    {
        $user = User::findorFail($id);
        $this -> validate($request,[
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id
        ]);
        $input = $request->only(['name', 'email', /*'password'*/]);  
        $user->fill($input)->save();

        return redirect('admin/users/edit/'.$id)
            ->with('flash_message',
             'User successfully edited.');
    }

    public function getDelete($id)
    {
        $user = User::findorFail($id);
        $user->delete();

        return redirect('admin/users/list')->with('flash_message','User successfully deleted.');
    }
}
