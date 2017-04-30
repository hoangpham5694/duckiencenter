<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Teacher;
use App\Payout;
use App\Http\Requests\PayinAddRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PayoutAddRequest;
class PayoutController extends Controller
{
    public function getIndexPayoutAdmin()
    {
    	return view('admin.payout.index');
    }
    public function getAddPayoutAdmin($teacherid)
    {
    	$teacher = Teacher::findOrFail($teacherid);
		$user = Auth::guard('users')->user();
    	return view('admin.payout.add',['teacher'=>$teacher,'user'=>$user]);
    }
    public function postAddPayoutAdmin(PayoutAddRequest $request, $teacherid)
    {
    	
    	try {
            DB::beginTransaction();
           	$teacher = Teacher::findOrFail($teacherid);
    		$user = Auth::guard('users')->user();
            $payout = new Payout();
            $payout->teacher_id = $teacher->id;
            $payout->user_id = $user->id;
          	if($request->txtpaymoney > $teacher->amount){
          		return back()->with(['flash_level'=>'alert-danger','flash_message' => 'Số tiền vượt quá số dư trong tài khoản'] );
          		//echo $request->txtpaymoney."---".$teacher->amount;
          	//	return "Ssố tiền hơn mức cho phép";
          	}

            $payout->paid_money = $request->txtpaymoney;
            $payout->amount = $teacher->amount - $request->txtpaymoney;
            $payout->is_paid = 1;
            $teacher->amount = $teacher->amount - $request->txtpaymoney;
            $payout->save();
            $teacher->save();
            DB::commit();
           // $url = "adminsites/payin/detail/"+$payin->id;
            return redirect()->action('PayoutController@getDetailPayoutAdmin',['id'=>$payout->id]);
        //	return "Xử lý thành công";
        } catch (Exception $e) {
           // printf $e;
            DB::rollback();
            return "Lỗi trong quá tình xử lý";
        }
    }
    public function getDetailPayoutAdmin($id)
    {
        $payout = Payout::join('teachers','teachers.id','=','payout.teacher_id')
        ->join('users','users.id','=','payout.user_id')
        ->select('payout.id','payout.is_paid','teachers.username','teachers.firstname','teachers.lastname','users.name','payout.paid_money','payout.amount','payout.created_at')
        ->where('payout.id','=',$id)->first();

        return view('admin.payout.detail',['payout'=>$payout]);
    }
    public function getBillPayOutAdmin($id)
    {
		 $payout = Payout::join('teachers','teachers.id','=','payout.teacher_id')
        ->join('users','users.id','=','payout.user_id')
        ->select('payout.id','payout.is_paid','teachers.username','teachers.firstname','teachers.lastname','users.name','payout.paid_money','payout.amount','payout.created_at')
        ->where('payout.id','=',$id)->first();

        return view('admin.payout.bill',['payout'=>$payout]);
    }
}
