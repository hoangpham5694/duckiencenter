@extends('admin.master')
@section('header')
    <title>Admin::Thêm mới Học viên</title>
@endsection
@section('title','Thêm mới Học viên')
@section('content')
<div class="col-md-7"  >
  <form  action=""  method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Họ lót:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required="true" name="txtlastname" id="lastname"  placeholder="Vui lòng nhập Họ lót">
      
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="firstname">Tên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="true"  name="txtfirstname" id="firstname" placeholder="Vui lòng nhập Tên">

    </div>
  </div>
    <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="username">Mã học viên:</label>
    <div class="col-sm-9">
       
      <div class="input-group">
        <input type="text" class="form-control" pattern="hv[0-9]{5,11}" required="true" name="txtusername" id="username" placeholder="Vui lòng nhập mã học viên">
           
<span class="input-group-btn">

        <button class="btn btn-default" onclick="checkUnique()" type="button">

          Kiểm tra</button>
      </span>
      </div>
  
    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="gender">Giới tính:</label>
    <div class="col-sm-9">
    <select name="selectgender" class="form-control" id="gender">
      <option value="male">Nam</option>
       <option value="female">Nữ</option>
       <option value="other">Khác</option>
    </select>

    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-3" for="nation">Quốc tịch:</label>
    <div class="col-sm-9">
    <select name="selectnation" class="form-control" id="nation">
        @foreach($nations as $nation)
           <option value="{!! $nation->id !!}">{{ $nation->name }}</option>
        @endforeach
    </select>

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Email:</label>
    <div class="col-sm-9">
      <input type="email" class="form-control"  required="true" name="txtemail" id="email" placeholder="Vui lòng nhập email">

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Điện thoại:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" pattern="[0-9]{9,11}" required="true"   name="txtphone" id="phone" placeholder="Vui lòng nhập số điện thoại">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="parentphone">Điện thoại phụ huynh:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" pattern="[0-9]{9,11}"  name="txtparentphone" id="parentphone" placeholder="Vui lòng nhập số điện thoại phụ huynh">

    </div>
  </div>


    
    <div class="form-group">
    <label class="control-label col-sm-3" for="dob">Ngày sinh:</label>
    <div class="col-sm-9">
      <input type="date" class="form-control"   name="txtdob" id="dob" placeholder="Vui lòng nhập ngày sinh">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="address">Địa chỉ:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"   name="txtaddress" id="address" placeholder="Vui lòng nhập địa chỉ">

    </div>
  </div>

     
       


 



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit"   class="btn btn-default">Thêm học viên</button>
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
      url = api + "adminsites/student/checkunique/" + $("#username").val();
      console.log(url);
        $.get(url, function(data, status){
       // alert("Data: " + data + "\nStatus: " + status);
        if(data == "true"){
          $("#formGroupUsername").addClass("has-success");
        }else{
           $("#formGroupUsername").addClass("has-error");
        }
      });
    }
  </script>
@endsection
