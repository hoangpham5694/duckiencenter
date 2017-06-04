@extends('admin.master')
@section('header')
<title>Admin::Rút tiền</title>
@endsection
@section('title','Rút tiền tài khoản trung tâm')
@section('content')

<div class="row teacher-info">

  <div class="col-sm-8 info">

<form  action=""  method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="momentamount">Số tiền hiện có:</label>
    <div class="col-sm-9">  
       <input type="number" class="form-control" readonly value="{{ $account->amount }}"  decimals="3" id="momentamount">
    </div>
  </div>
  <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="paymoney">Số tiền rút:</label>
    <div class="col-sm-9">  
        <input type="number" class="form-control" required min="0" step="10000" max="20000000"  name="txtWithdrawal" id="paymoney">
    </div>
  </div>
<div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="afteramount">Số tiền còn lại:</label>
    <div class="col-sm-9">  
       <input type="number" class="form-control" readonly value="{{ $account->amount }}"  decimals="3" id="afteramount">
    </div>
  </div>
    

      


    
    <div class="form-group">
    <label class="control-label col-sm-3" for="txtdate">Ngày rút tiền:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" readonly id="txtdate">

    </div>
  </div>

     
       


 



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit"   class="btn btn-default">Thanh toán</button>
    </div>
  </div>
</form>






</div>

<div class="clearfix"></div>
</div>


@endsection
@section('footer')
  <script>
  function callAfterAmount(){

  }
$(document).ready( function() {
    var now = new Date();
    var today = now.getDate()  + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
  //  alert(today);
    $('#txtdate').val(today);
    var amount = parseInt($("#momentamount").val());
    $("#paymoney").change(function(){
     // console.log(amount);
     if($("#paymoney").val() == ""){
      $("#paymoney").val(0);
     }
     var payMoney = parseInt($("#paymoney").val());
     if(payMoney <0){
      //  console.log("<<<<");
        $("#paymoney").val(0);
     }else{

        if(payMoney <= amount){
          console.log(payMoney);
          $("#afteramount").val(amount-payMoney);
        }else{
            console.log(payMoney);
           $("#paymoney").val(amount);
           $("#afteramount").val(0);
        }
     }
    


    });
})
  </script>
@endsection
