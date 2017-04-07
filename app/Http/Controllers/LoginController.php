<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
class LoginController extends Controller
{
    public function getLogin(){
    	if(!Auth::guard('teachers')->check() || !Auth::guard('students')->check() || !Auth::guard('users')->check() ){
    		return view('login.login');
    	}else{
    	//	return redirect('adminsites');
    		echo "you are login";
    	}
    	
    }
    public function postLogin(LoginRequest $request){
    	 $login = ['username' => $request->txtUsername,
    	 'password' => $request->txtPassword
            
         ];
    	switch ($request->selectRole) {
    		case 'teacher':
    			if (Auth::guard('teachers')->attempt($login)){
    				echo "you are teacher";
    			}else{
    				echo "you are not teacher";
    			}
    			
    			break;
    		
    		default:
    			# code...
    			break;
    	}
    }
}
