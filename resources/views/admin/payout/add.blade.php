@extends('admin.master')
@section('header')
    <title>Admin::Thanh toán</title>
@endsection
@section('title','Thanh toan cho giáo viên')
@section('content')
<div class="col-md-7"  >
  <form  action=""  method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Tên giáo viên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $teacher->lastname }} {{ $teacher->firstname }}"  readonly="true" id="lastname"  >
      
    </div>
  </div>

    <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="username">Mã giáo viên:</label>
    <div class="col-sm-9">
       
   
        <input type="text" class="form-control" value="{{ $teacher->username }}" readonly="true"name="txtusername" id="username">
           

  
  
    </div>
  </div>

<div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="momentamount">Số tiền hiện có:</label>
    <div class="col-sm-9">  
       <input type="number" class="form-control" readonly value="{{ $teacher->amount }}"  decimals="3" id="momentamount">
    </div>
  </div>
  <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="paymoney">Số tiền nhận:</label>
    <div class="col-sm-9">  
        <input type="number" class="form-control" required min="0" step="10000" max="20000000"  name="txtpaymoney" id="paymoney">
    </div>
  </div>
<div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="afteramount">Số tiền còn lại:</label>
    <div class="col-sm-9">  
       <input type="number" class="form-control" readonly value="{{ $teacher->amount }}"  decimals="3" id="afteramount">
    </div>
  </div>
    
 <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="employ">Nhân viên thanh toán:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $user->name }}" readonly="true"name="employ" id="employ">
           

  
  
    </div>
  </div>
      


    
    <div class="form-group">
    <label class="control-label col-sm-3" for="txtdate">Ngày nạp tiền:</label>
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
