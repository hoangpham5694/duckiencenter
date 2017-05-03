@extends('manager.master')
@section('header')
    <title>Manager::Nạp tiền</title>
@endsection
@section('title','Nạp tiền vào tài khoản học viên')
@section('content')
<div class="col-md-7"  >
  <form  action=""  method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Tên học viên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $student->lastname }} {{ $student->firstname }}"  readonly="true" id="lastname"  >
      
    </div>
  </div>

    <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="username">Mã học viên:</label>
    <div class="col-sm-9">
       
   
        <input type="text" class="form-control" value="{{ $student->username }}" readonly="true"name="txtusername" id="username">
           

  
  
    </div>
  </div>
<div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="realmoney">Số tiền thu:</label>
    <div class="col-sm-9">
       
   
        <input type="number" class="form-control" required min="0" max="5000000"  decimals="3"  name="txtrealmoney" id="realmoney">
           

  
  
    </div>
  </div>
  <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="virtualmoney">Số tiền nhận được:</label>
    <div class="col-sm-9">  
        <input type="number" class="form-control" required min="0" max="5000000"  name="txtvirtualmoney" id="virtualmoney">
    </div>
  </div>

    
 <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="employ">Nhân viên thu tiền:</label>
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
      <button type="submit"   class="btn btn-default">Thu tiền</button>
    </div>
  </div>
</form>

</div>
<div class="clearfix"></div>
@endsection
@section('footer')
  <script>
$(document).ready( function() {
    var now = new Date();
    var today = now.getDate()  + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
  //  alert(today);
    $('#txtdate').val(today);
    $("#realmoney").keyup(function(){
      console.log("change");
      $("#virtualmoney").val($("#realmoney").val());

    });
})
  </script>

@endsection
