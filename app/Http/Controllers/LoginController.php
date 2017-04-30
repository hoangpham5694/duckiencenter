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
    public function postLogin(LoginRequest $request){
    	 $login = ['username' => $request->txtUsername,
    	 'password' => $request->txtPassword,
            'status'=> 'active'
         ];
    	switch ($request->selectRole) {
    		case 'teacher':
    			if (Auth::guard('teachers')->attempt($login)){
    				echo "you are teacher";
    			}else{
    				echo "you are not teacher";
    			}
    			
    			break;
    		case 'student':
                if (Auth::guard('students')->attempt($login)){
                    echo "you are student";
                }else{
                    echo "you are not student";
                }
                break;
            case 'admin':
                $login = ['username' => $request->txtUsername,
                'password' => $request->txtPassword,
                'role' => 1,
                'status' =>'active'
                ];
                if (Auth::guard('users')->attempt($login)){
                    echo "you are admin";
                }else{
                    echo "you are not admin";
                }
                break;
            case 'manager':

                if (Auth::guard('users')->attempt($login)){
                    echo "you are manager";
                }else{
                    echo "you are not manager";
                }
                break;               
    		default:
    			# code...
    			break;
    	}
    }
}
