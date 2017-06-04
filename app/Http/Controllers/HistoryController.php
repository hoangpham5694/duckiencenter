<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\HistoryMoney;
use App\Teacher;
use App\Http\Requests\WithdrawalRequest;
class HistoryController extends Controller
{
    public function getIndex()
    {
    	$ducKienAccount = Teacher::findOrFail(0);
    	return view('admin.historys.index',['ducKienAccount'=>$ducKienAccount]);
    }
   	public function getWithdrawal()
    {
    	$account = Teacher::findOrFail(0);
    	return view('admin.historys.withdrawal',['account'=>$account]);
    }
    public function postWithdrawal(WithdrawalRequest $request)
    {
    	$account = Teacher::findOrFail(0);
    	$withdrawalMoney = $request->txtWithdrawal;
    	if($withdrawalMoney > $account->amount ){
    		return redirect("adminsites/history/withdrawal")->with(['flash_level'=>'alert-danger','flash_message' => 'Số tiền không đủ'] );

    	}
    	   
		$account->amount -=$withdrawalMoney;
    	$account->save();
    	$history = new HistoryMoney();
    	$history->money = $withdrawalMoney;
    	$history->amount = $account->amount;
    	$history->name = "Rút tiền tài khoản chính";
    	$history->status = "withdrawal";
    	$history->save();
    	$url = "adminsites/history/detailwithdrawal/".$history->id;
    	return redirect($url)->with(['flash_level'=>'alert-success','flash_message' => 'Rút tiền thành công'] );

    }
    public function getDetailWithdrawal($id)
    {
    	$history = HistoryMoney::findOrFail($id);
    	return view('admin.historys.detailwithdrawal',['history'=>$history]);
    }
    public function getWithdrawalBill($id)
    {
    	$history = HistoryMoney::findOrFail($id);
    	return view('admin.historys.withdrawalbill',['history'=>$history]);

    }
}
