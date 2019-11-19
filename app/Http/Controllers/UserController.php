<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getList()
    {
        $users = User::paginate(5);
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
        
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_permission = $request->is_permission;
        $user->verified = $request->verified;
        $user->save();  

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
        
        $this -> validate($request,[
            'name'=>'required|max:120',
        ]);
        $user = User::findorFail($id);
        $user->name = $request->name;
        $user->is_permission = $request->is_permission; 
        if ($request->changePassword == "on") {
            $this ->validate($request,
            [
                'password'=>'required|min:8|confirmed',
                'password_confirmation' => 'min:8|same:password'
            ]);

            $user->password = bcrypt($request->password);
        }

        $user->save();

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


    public function getadminLogout()
    {
        Auth::logout();
        return redirect('home');
    }
}
