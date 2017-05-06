<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    public function getLogin(){
    /*	if(!Auth::guard('teachers')->check() && !Auth::guard('students')->check() && !Auth::guard('users')->check() ){
    		return view('login.login');
    	}else{
    	//	return redirect('adminsites');
    		echo "you are login as ";
            if(Auth::guard('teachers')->check()) echo "teacher";
            if(Auth::guard('students')->check()) echo "student";
            if(Auth::guard('users')->check()) echo "user";
    	}
        */
    	return view('login.login');
    }
    public function getLogout(){
        Auth::guard('students')->logout();
        Auth::guard('teachers')->logout();
        Auth::guard('users')->logout();

        return redirect()->route('getLogin');
    }
    public function postLogin(LoginRequest $request){
    	 $login = ['username' => $request->txtUsername,
    	 'password' => $request->txtPassword,
            'status'=> 'active'
         ];
    	switch ($request->selectRole) {
    		case 'teacher':
    			if (Auth::guard('teachers')->attempt($login)){
    			//	echo "you are teacher";
                    return redirect('teachersites');
    			}else{
    				//echo "you are not teacher";
                    return redirect('login')
                    ->with(['flash_level'=>'alert-danger','flash_message' => 'Sai tên đăng nhập hoặc mật khẩu'] );

    			}
    			
    			break;
    		case 'student':
                if (Auth::guard('students')->attempt($login)){
                  //  echo "you are student";
                    return redirect('studentsites');
                }else{
                   // echo "you are not student";
                    return redirect('login')
                    ->with(['flash_level'=>'alert-danger','flash_message' => 'Sai tên đăng nhập hoặc mật khẩu'] );

                }
                break;
            case 'admin':
                $login = ['username' => $request->txtUsername,
                'password' => $request->txtPassword,
                'role' => 1,
                'status' =>'active'
                ];
                if (Auth::guard('users')->attempt($login)){
                   // echo "you are admin";
                    return redirect('adminsites');
                }else{
                  //  echo "you are not admin";
                     return redirect('login')
                    ->with(['flash_level'=>'alert-danger','flash_message' => 'Sai tên đăng nhập hoặc mật khẩu'] );

                }
                break;
            case 'manager':

                if (Auth::guard('users')->attempt($login)){
                  //  echo "you are manager";
                      return redirect('managersites');
                }else{
                   // echo "you are not manager";
                      return redirect('login')
                    ->with(['flash_level'=>'alert-danger','flash_message' => 'Sai tên đăng nhập hoặc mật khẩu'] );

                }
                break;               
    		default:
    			# code...
    			break;
    	}
    }
}
