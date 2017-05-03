<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Student;
use App\Payin;
use App\Http\Requests\PayinAddRequest;
use Illuminate\Support\Facades\DB;
class PayinController extends Controller
{
    public function getIndexPayinAdmin()
    {
    	return view('admin.payin.index');
    }
    public function getIndexPayinManager()
    {
        return view('manager.payin.index');
    }
    public function getAddPayinAdmin($studentid)
    {
    	$student = Student::findOrFail($studentid);
		$user = Auth::guard('users')->user();
    	return view('admin.payin.add',['student'=>$student,'user'=>$user]);
    }
    public function getAddPayinManager($studentid)
    {
        $student = Student::findOrFail($studentid);
        $user = Auth::guard('users')->user();
        return view('manager.payin.add',['student'=>$student,'user'=>$user]);
    }

    public function postAddPayinAdmin(PayinAddRequest $request, $studentid)
    {
        try {
            DB::beginTransaction();
            $student = Student::findOrFail($studentid);
            $user = Auth::guard('users')->user();
            $payin = new Payin();
            $payin->student_id = $student->id;
            $payin->user_id = $user->id;
            $payin->real_money = $request->txtrealmoney;
            $payin->virtual_money = $request->txtvirtualmoney;
            $payin->amount = $student->amount + $request->txtvirtualmoney;
            $payin->is_paid = 1;
            $student->amount = $student->amount + $request->txtvirtualmoney;
            $payin->save();
            $student->save();
            DB::commit();
           // $url = "adminsites/payin/detail/"+$payin->id;
            return redirect()->action('PayinController@getDetailPayinAdmin',['id'=>$payin->id]);
        } catch (Exception $e) {
           // printf $e;
            DB::rollback();
            return "Lỗi trong quá tình xử lý";
        }
    	


    }
    public function postAddPayinManager(PayinAddRequest $request, $studentid)
    {
        try {
            DB::beginTransaction();
            $student = Student::findOrFail($studentid);
            $user = Auth::guard('users')->user();
            $payin = new Payin();
            $payin->student_id = $student->id;
            $payin->user_id = $user->id;
            $payin->real_money = $request->txtrealmoney;
            $payin->virtual_money = $request->txtvirtualmoney;
            $payin->amount = $student->amount + $request->txtvirtualmoney;
            $payin->is_paid = 1;
            $student->amount = $student->amount + $request->txtvirtualmoney;
            $payin->save();
            $student->save();
            DB::commit();
           // $url = "adminsites/payin/detail/"+$payin->id;
            return redirect()->action('PayinController@getDetailPayinManager',['id'=>$payin->id]);
        } catch (Exception $e) {
           // printf $e;
            DB::rollback();
            return "Lỗi trong quá tình xử lý";
        }
        


    }
    public function getDetailPayinAdmin($id)
    {
        $payin = Payin::join('students','students.id','=','payin.student_id')
        ->join('users','users.id','=','payin.user_id')
        ->select('payin.id','payin.is_paid','students.username','students.firstname','students.lastname','users.name','payin.real_money','payin.virtual_money','payin.amount','payin.created_at')
        ->where('payin.id','=',$id)->first();

        return view('admin.payin.detail',['payin'=>$payin]);
    }
    public function getBillPayinAdmin($id)
    {
        $payin = Payin::join('students','students.id','=','payin.student_id')
        ->join('users','users.id','=','payin.user_id')
        ->select('payin.id','payin.is_paid','students.username','students.firstname','students.lastname','users.name','payin.real_money','payin.virtual_money','payin.amount','payin.created_at')
        ->where('payin.id','=',$id)->first();
        return view('admin.payin.bill',['payin'=>$payin]);
    }
        public function getDetailPayinManager($id)
    {
        $payin = Payin::join('students','students.id','=','payin.student_id')
        ->join('users','users.id','=','payin.user_id')
        ->select('payin.id','payin.is_paid','students.username','students.firstname','students.lastname','users.name','payin.real_money','payin.virtual_money','payin.amount','payin.created_at')
        ->where('payin.id','=',$id)->first();

        return view('manager.payin.detail',['payin'=>$payin]);
    }
    public function getBillPayinManager($id)
    {
        $payin = Payin::join('students','students.id','=','payin.student_id')
        ->join('users','users.id','=','payin.user_id')
        ->select('payin.id','payin.is_paid','students.username','students.firstname','students.lastname','users.name','payin.real_money','payin.virtual_money','payin.amount','payin.created_at')
        ->where('payin.id','=',$id)->first();
        return view('manager.payin.bill',['payin'=>$payin]);
    }
}
