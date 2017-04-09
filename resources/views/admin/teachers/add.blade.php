@extends('admin.master')
@section('header')
    <title>Admin::Thêm giáo viên</title>
@endsection
@section('title','Thêm giáo viên')
@section('content')

<div class="col-md-7" >
	<form name="frmTeacher" action="" method="post" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="name">Họ tên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" ng-model="teacher.name" ng-required="true" name="txtname" id="txtname" placeholder="Vui lòng nhập tên giáo viên">
      <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtname.$error.required">Vui lòng nhập họ tên</span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Email:</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" ng-model="teacher.email" ng-required="true" name="txtemail" id="name" placeholder="Vui lòng nhập email">
      <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtemail.$error.required">Vui lòng nhập email</span>
      <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtemail.$error.email">Email phải đúng định dạng</span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Điện thoại:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" ng-model="teacher.phone" ng-required="true" ng-pattern="/^[0-9]{9,11}$/" name="txtphone" id="phone" placeholder="Vui lòng nhập số điện thoại">
      <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtphone.$error.required">Vui lòng nhập số điện thoại</span>
      <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtphone.$error.pattern">Số điện thoại chưa đúng định dạng</span>
    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Chi nhánh:</label>
    <div class="col-sm-9">
    <select class="form-control" name="selectagency">
      @foreach($agencies as $agency)
          <option value="{{ $agency->id }}">{{ $agency->name }}</option>
      @endforeach


</select>

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="dob">Ngày sinh:</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" ng-model="teacher.dob"   name="txtdob" id="dob" placeholder="Vui lòng nhập ngày sinh">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" for="address">Địa chỉ:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" ng-model="teacher.address"   name="txtaddress" id="address" placeholder="Vui lòng nhập địa chỉ">

    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Mật khẩu:</label>
    <div class="col-sm-9"> 
      <input type="password" class="form-control" ng-minLength="6" name="txtpassword" ng-required="true" ng-model="teacher.password" id="password" placeholder="Nhập mật khẩu">
		<span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtpassword.$error.required">Vui lòng nhập mật khẩu</span>
        <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtpassword.$error.minlength">Mật khẩu phải tối thiểu 6 kí tự</span>
   	 </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Nhập lại mật khẩu:</label>
    <div class="col-sm-9"> 
      <input type="password" class="form-control" pw-check='password' name="repassword"  ng-model="teacher.repassword" id="repassword" placeholder="Nhập mật khẩu">
		<span id="helpBlock2" class="text-danger" ng-show="frmTeacher.repassword.$error.pwmatch">Mật khẩu phải khớp</span>
   	 </div>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" ng-disabled="frmTeacher.$invalid"  class="btn btn-default">Thêm giáo viên</button>
    </div>
  </div>
</form>

</div>

@endsection
@section('footer')
 <script src="<?php echo asset('public/app/controller/TeacherController.js') ; ?>"></script> 
@endsection
