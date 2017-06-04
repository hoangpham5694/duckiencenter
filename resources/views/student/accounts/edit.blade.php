@extends('student.master')
@section('header')
    <title>Học viên::Chỉnh sửa thông tin</title>
@endsection
@section('title','Chỉnh sửa thông tin')
@section('content')
<div class="col-md-7"  >

  <form  action=""  method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Họ lót:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required="true" name="txtlastname" id="lastname"  placeholder="Vui lòng nhập Họ lót" value="{{ $student->lastname }}">
      
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="firstname">Tên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="true" value="{{ $student->firstname }}" name="txtfirstname" id="firstname" placeholder="Vui lòng nhập Tên">

    </div>
  </div>
    <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="username">Mã học viên:</label>
    <div class="col-sm-9">
       
     
        <input type="text" class="form-control" value="{{ $student->username }}" readonly="true" id="username" placeholder="Vui lòng nhập mã học viên">
           
  

  
    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="gender">Giới tính:</label>
    <div class="col-sm-9">
    <select name="selectgender" class="form-control" id="gender">
      <option value="male" <?php if($student->gender == "male") echo "selected" ?> >Nam</option>
       <option value="female" <?php if($student->gender == "female") echo "selected" ?>>Nữ</option>
       <option value="other" <?php if($student->gender == "other") echo "selected" ?>>Khác</option>
    </select>

    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-3" for="nation">Quốc tịch:</label>
    <div class="col-sm-9">
    <select name="selectnation" class="form-control" id="nation">
        @foreach($nations as $nation)
           <option value="{!! $nation->id !!}" <?php if($student->nation_id == $nation->id) echo "selected" ?>>{{ $nation->name }}</option>
        @endforeach
    </select>

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Email:</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" value="{{ $student->email }}" required="true" name="txtemail" id="email" placeholder="Vui lòng nhập email">

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Điện thoại:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $student->phone }}" pattern="[0-9]{9,11}" required="true"   name="txtphone" id="phone" placeholder="Vui lòng nhập số điện thoại">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="parentphone">Điện thoại phụ huynh:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $student->parents_phone }}" pattern="[0-9]{9,11}"  name="txtparentphone" id="parentphone" placeholder="Vui lòng nhập số điện thoại phụ huynh">

    </div>
  </div>


    
    <div class="form-group">
    <label class="control-label col-sm-3" for="dob">Ngày sinh:</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" value="{{ $student->dob }}"  name="txtdob" id="dob" placeholder="Vui lòng nhập ngày sinh">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="address">Địa chỉ:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $student->address }}"  name="txtaddress" id="address" placeholder="Vui lòng nhập địa chỉ">

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

      <input type="password" class="form-control" name="txtpassword"   id="password" placeholder="Nhập mật khẩu">

     </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Nhập lại mật khẩu:</label>
    <div class="col-sm-9"> 
      <input type="password" class="form-control"  name="txtrepassword"   id="repassword" placeholder="Nhập mật khẩu">

     </div>
  </div>


 



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit"   class="btn btn-default">Sửa học viên</button>
    </div>
  </div>
</form>


</div>
<div class="clearfix"></div>
@endsection
@section('footer')
  
  <script>
    var api = "{!! asset('/') !!}";

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
