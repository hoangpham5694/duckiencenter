@extends('admin.master')
@section('header')
    <title>Admin::Chỉnh sửa Nhân viên</title>
@endsection
@section('title','Chỉnh sửa Nhân viên')
@section('content')
<div class="col-md-7"  >
  <form  action=""  method="POST"  class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Họ tên:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control"  required="true" name="txtlastname" id="lastname" value="{{ $user->lastname }}" placeholder="Họ lót">
      
    </div>
     <div class="col-sm-4">
      <input type="text" class="form-control" value="{{ $user->firstname }}" required="true"  name="txtfirstname" id="firstname" placeholder="Tên">

    </div>
  </div>

    <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="username">Tên đăng nhập:</label>
    <div class="col-sm-9">
       
      
        <input type="text" class="form-control" value="{{ $user->username }}" readonly id="username" >
           

   
   <span id="helpBlockUniqueUsernameError" class="text-danger" >Tên đăng nhập không hợp lệ</span>
   <span id="helpBlockUniqueUsernameSuccess" class="text-success" >Tên đăng nhập hợp lệ</span>
    </div>
  </div>

   <div class="form-group">
    <label class="control-label col-sm-3" for="nation">Vai trò:</label>
    <div class="col-sm-9">
    <select name="selectrole" class="form-control" id="nation">
        @foreach($roles as $role)
          @if( $role->id == $user->role)
              <option selected value="{!! $role->id !!}">{{ $role->name }}</option>
          @else
              <option value="{!! $role->id !!}">{{ $role->name }}</option>
          @endif
           
        @endforeach
    </select>

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Email:</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" value="{{ $user->email }}" required="true" name="txtemail" id="email" placeholder="Vui lòng nhập email">

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Điện thoại:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" pattern="[0-9]{9,11}" value="{{ $user->phone }}" required="true"   name="txtphone" id="phone" placeholder="Vui lòng nhập số điện thoại">

    </div>
  </div>
  <hr>
      <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
        <p class="text-info">Chỉ nhập trường mật khẩu khi muốn thay đổi mật khẩu</p> 
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Mật khẩu:</label>
    <div class="col-sm-9"> 
      <input type="password" class="form-control"  name="txtpassword"   id="password" placeholder="Nhập mật khẩu">
 
      
     </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Nhập lại mật khẩu:</label>
    <div class="col-sm-9"> 
      <input type="password" class="form-control" name="repassword"   id="repassword" placeholder="Nhập mật khẩu">
    <span id="helpBlockComparePass" class="text-danger" >Mật khẩu phải khớp</span>
     </div>
  </div>



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit"   class="btn btn-default">Sửa nhân viên</button>
    </div>
  </div>
</form>

</div>
<div class="clearfix"></div>
@endsection
@section('footer')
  
  <script>
    var api = "{!! asset('/') !!}";
    function checkUnique(){
      //alert("check");
      url = api + "adminsites/user/checkunique/" + $("#username").val();
      console.log(url);
        $.get(url, function(data, status){
       // alert("Data: " + data + "\nStatus: " + status);
        if(data == "true"){
          $("#formGroupUsername").addClass("has-success");
          $("#formGroupUsername").removeClass("has-error");

              $("#helpBlockUniqueUsernameError").hide();
              $("#helpBlockUniqueUsernameSuccess").show();
        }else{
           $("#formGroupUsername").addClass("has-error");
           $("#formGroupUsername").removeClass("has-success");
            $("#helpBlockUniqueUsernameError").show();
            $("#helpBlockUniqueUsernameSuccess").hide();
        }
      });
    }
   $(document).ready(function($) {
      $("#helpBlockComparePass").hide();
      $("#helpBlockUniqueUsernameError").hide();
      $("#helpBlockUniqueUsernameSuccess").hide();
      $("#repassword").keyup(function(){
        if($("#repassword").val() == $("#password").val()){
          $("#helpBlockComparePass").hide();
        }else{
            $("#helpBlockComparePass").show();
        }
      });
    });
  </script>
@endsection
