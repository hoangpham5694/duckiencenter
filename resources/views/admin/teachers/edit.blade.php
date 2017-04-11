@extends('admin.master')
@section('header')
    <title>Admin::Sửa giáo viên</title>
@endsection
@section('title','Sửa giáo viên')
@section('content')

<div class="col-md-7"  >
	<form  action="" method="post" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="name">Họ tên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $teacher['name'] }}" required name="txtname" id="txtname" placeholder="Vui lòng nhập tên giáo viên" >
 
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Email:</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" value="{{ $teacher['email'] }}" required="true" name="txtemail" id="name" placeholder="Vui lòng nhập email">

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Điện thoại:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $teacher['phone'] }}"  ng-required="true" pattern="[0-9]{9,11}" name="txtphone" id="phone" placeholder="Vui lòng nhập số điện thoại">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Chi nhánh:</label>
    <div class="col-sm-9">
    <select class="form-control" name="selectagency">
      @foreach($agencies as $agency)
        @if($agency->id == $teacher['agency_id'])
          <option value="{{ $agency->id }}" selected="true">{{ $agency->name }}</option>
        @else
          <option value="{{ $agency->id }}">{{ $agency->name }}</option>
        @endif
      @endforeach


</select>

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="dob">Ngày sinh:</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" value="{{ $teacher['dob'] }}"  name="txtdob" id="dob" placeholder="Vui lòng nhập ngày sinh">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="address">Địa chỉ:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $teacher['address'] }}"   name="txtaddress" id="address" placeholder="Vui lòng nhập địa chỉ">

    </div>
  </div>
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
      <button type="submit"   class="btn btn-default">Sửa giáo viên</button>
    </div>
  </div>
</form>

</div>

@endsection
@section('footer')
 <script src="<?php echo asset('public/app/controller/admins/TeacherController.js') ; ?>"></script> 

@endsection
