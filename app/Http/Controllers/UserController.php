<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

//use App\Http\Requests\UserEditRequest;
use App\User;
use App\Role;
use App\Http\Requests\UserEditRequest;
use Hash;

class UserController extends Controller
{
    public function getListUser()
    {
    	return view('admin.users.list');
    }
    public function getStudentTotalJson()
    {
    	return User::where('status','=','active')->count();
    }
    public function getListStudentJson(Request $request, $max, $page)
    {
    	$numberRecord= $max;
        $vitri =($page -1 ) * $numberRecord;
        $key = $request->key;
        $orderby = $request->orderby;
        $sort = $request->sort;
    	$users = User::join('roles','roles.id','=','users.role')
    	->select('users.id','users.username','users.firstname','users.lastname','users.phone','roles.name as role')
    	->where('status','=','active')
    	->where(function($query) use ($key){
            $query->where('username','LIKE','%'.$key.'%')
            ->orWhere('firstname','LIKE','%'.$key.'%')
            ->orWhere('lastname','LIKE','%'.$key.'%')
            ->orWhere('email','LIKE','%'.$key.'%')
            ->orWhere('phone','LIKE','%'.$key.'%');
     
        })
        ->orderBy($orderby,$sort)->limit($numberRecord)->offset($vitri)->get();
        return $users;
    }
    public function getAddUserAdmin()
    {
    	$roles = Role::select('id','name')->get();
    	return view('admin.users.add',['roles'=>$roles]);
    }
    public function getCheckUnique($username = ""){
        if($username == "") return "false";
        $users = User::where('username','=',$username)->count();
        if($users >0){
            return 'false';
        }
        return 'true';
    }
    public function postAddUserAdmin(UserAddRequest $request)
    {
    	$user = new User();
    	$user->username = $request->txtusername;
    	$user->firstname = $request->txtfirstname;
    	$user->lastname = $request->txtlastname;
    	$user->name = $request->txtlastname." ".$request->txtfirstname;
    	$user->role = $request->selectrole;
    	$user->email = $request->txtemail;
    	$user->phone = $request->txtphone;
    	$user->password = Hash::make($request->txtpassword);
    	$user->status = "active";
    	$user->save();
    	return redirect('adminsites/user/list')->with(['flash_level'=>'alert-success','flash_message' => 'Thêm nhân viên thành công'] );
    }
    public function getEditUserAdmin($id)
    {
    	$user = User::findOrFail($id);
    	$roles = Role::select('id','name')->get();
    	return view('admin.users.edit',['user'=>$user,'roles'=>$roles]);
    }
    public function postEditUserAdmin(UserEditRequest $request, $id){
    	$user = User::findOrFail($id);
    	$user->firstname = $request->txtfirstname;
    	$user->lastname = $request->txtlastname;
    	$user->name = $request->txtlastname." ".$request->txtfirstname;
    	$user->role = $request->selectrole;
    	$user->email = $request->txtemail;
    	$user->phone = $request->txtphone;
    	if($request->txtpassword != null){
    		$user->password = Hash::make($request->txtpassword);
    	}
    	$user->save();
    	return redirect('adminsites/user/list')->with(['flash_level'=>'alert-success','flash_message' => 'Sửa nhân viên thành công'] );

    }
    public function getDeleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->status = "delete";
        $user->save();
        return "Xóa thành công";
    }
}
