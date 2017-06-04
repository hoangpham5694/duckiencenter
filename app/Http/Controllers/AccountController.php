<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\StudentEditRequest;
use App\User;
use App\Student;
use App\Role;
use App\Nation;
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
    public function getProfileStudent()
    {
        $student =  Auth::guard('students')->user();
        $student = Student::findOrFail($student->id);
        return view('student.accounts.profile',['student'=>$student]);
    }
    public function getEditStudent()
    {
        $student =  Auth::guard('students')->user();
        $student = Student::findOrFail($student->id);
        $nations = Nation::get();
        return view('student.accounts.edit',['student'=>$student,'nations'=>$nations]);
    }
    public function postEditStudent(StudentEditRequest $request){
        $student =  Auth::guard('students')->user();
        $student = Student::findOrFail($student->id);
        $student->firstname = $request->txtfirstname;
        $student->lastname = $request->txtlastname;
        $student->name = $request->txtlastname.' '.$request->txtfirstname;
        $student->username = $request->txtusername;
        $student->gender = $request->selectgender;

        $student->nation_id = $request->selectnation;
        $student->email = $request->txtemail;
        $student->phone = $request->txtphone;
        $student->parents_phone = $request->txtparentphone;
        $student->dob = $request->txtdob;
        $student->address = $request->txtaddress;

        if($request->txtpassword != null){
            $student->password = Hash::make($request->txtpassword);
        }
       
        $student->save();
        $url = "studentsites/account/profile/";
       // $url = "adminsites/student/detail/7";
        return redirect($url)
        ->with(['flash_level'=>'alert-success','flash_message' => 'Sửa thông tin thành công'] );

    }
    public function getEditAdmin()
    {
    	$roles = Role::select('id','name')->get();
    	$user =  Auth::guard('users')->user();
    	$user = User::findOrFail($user->id);
		return view('admin.accounts.edit',['user'=>$user,'roles'=>$roles]);
    }

    public function postEditAdmin(UserEditProfileRequest $request)
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
       public function getProfileManager()
    {
        $user =  Auth::guard('users')->user();
        $user = User::join('roles','roles.id','=','users.role')
        ->select('users.id','users.username','users.firstname','users.lastname','users.email','users.phone','roles.name as role_name')
        ->where('users.id','=',$user->id)->first();
        return view('manager.accounts.profile',['user'=>$user]);

    }
    public function getEditManager()
    {
        $roles = Role::select('id','name')->get();
        $user =  Auth::guard('users')->user();
        $user = User::findOrFail($user->id);
        return view('manager.accounts.edit',['user'=>$user,'roles'=>$roles]);
    }
    public function postEditManager(UserEditProfileRequest $request)
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
        return redirect()->action('AccountController@getProfileManager')->with(['flash_level'=>'alert-success','flash_message' => 'Sửa Thông tin thành công'] );
    }


    public function getProfileTeacher()
    {
     
    }
    public function getEditTeacher()
    {
      
    }
    public function postEditTeacher(){
        

    }


}
