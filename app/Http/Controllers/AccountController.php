<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Hash;
use App\Http\Requests\UserEditProfileRequest;
class AccountController extends Controller
{
    public function getProfileAdmin()
    {
    	$user =  Auth::guard('users')->user();
    	$user = User::join('roles','roles.id','=','users.role')
    	->select('users.id','users.username','users.firstname','users.lastname','users.email','users.phone','roles.name as role_name')
    	->where('users.id','=',$user->id)->first();
    	return view('admin.accounts.profile',['user'=>$user]);

    }
    public function getEditAdmin()
    {
    	$roles = Role::select('id','name')->get();
    	$user =  Auth::guard('users')->user();
    	$user = User::findOrFail($user->id);
		return view('admin.accounts.edit',['user'=>$user,'roles'=>$roles]);
    }
    public function postEditUser(UserEditProfileRequest $request)
    {
    	$user =  Auth::guard('users')->user();
    	$user = User::findOrFail($user->id);
    	$user->firstname = $request->txtfirstname;
    	$user->lastname = $request->txtlastname;
    	$user->name = $request->txtlastname." ".$request->txtfirstname;
    
    	$user->email = $request->txtemail;
    	$user->phone = $request->txtphone;
    	if($request->txtpassword != null){
    		$user->password = Hash::make($request->txtpassword);
    	}
    	$user->save();
    	return redirect()->action('AccountController@getProfileAdmin')->with(['flash_level'=>'alert-success','flash_message' => 'Sửa Thông tin thành công'] );
    }
}
