@extends('admin.master')
@section('header')
    <title>Admin::Thêm giáo viên</title>
    <script src="{!! asset('public/ckeditor/ckeditor.js') !!}"></script>
@endsection
@section('title','Thêm giáo viên')
@section('content')

<div class="col-md-7" >
	<form name="frmTeacher" action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Họ lót:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" ng-model="teacher.lastname" ng-required="true" name="txtlastname" id="lastname" placeholder="Vui lòng nhập Họ lót">
      <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtlastname.$error.required">Vui lòng nhập Họ Lót</span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="firstname">Tên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" ng-model="teacher.firstname" ng-required="true" name="txtfirstname" id="firstname" placeholder="Vui lòng nhập Tên">
      <span id="helpBlock2" class="text-danger" ng-show="frmTeacher.txtfirstname.$error.required">Vui lòng nhập Tên</span>
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
    <label class="control-label col-sm-3" for="degree">Trình độ:</label>
    <div class="col-sm-9">
    <select class="form-control" id="degree" name="selectdegree">
          <option value="Cao đẳng">Cao đẳng</option>
          <option value="Đại học">Đại học</option>
          <option value="Thạc sĩ">Thạc sĩ</option>
          <option value="Tiến sĩ">Tiến sĩ</option>
          <option value="Phó giáo sư">Phó giáo sư</option>
          <option value="Giáo sư">Giáo sư</option>
</select>

    </div>
  </div>
        <div class="form-group">
    <label class="control-label col-sm-3" for="salarylevel">Bậc lương:</label>
    <div class="col-sm-9">
    <select class="form-control" id="salarylevel" name="selectsalarylevel">
         @foreach($salaryLevels as $salarylevel)
           <option value="{{ $salarylevel->id }}">{{ $salarylevel->percent }}</option>
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
    <label class="control-label col-sm-3" for="diploma">Bằng cấp:</label>
    <div class="col-sm-9">
  
      <textarea name="txtdiploma" id="diploma" class="form-control" rows="3" placeholder="Vd: Bằng cử nhân, Bằng đại học, Tiếng anh B1...."></textarea>
    </div>
  </div>
        <div class="form-group">
    <label class="control-label col-sm-3" for="skill">Kỹ năng:</label>
    <div class="col-sm-9">
  
      <textarea name="txtskill" id="skill" class="form-control" rows="3" placeholder="Vd: Vật lý, hóa học, anh văn..."></textarea>
    </div>
  </div>
          <div class="form-group">
    <label class="control-label col-sm-3" for="workhistory">Địa điểm đã công tác:</label>
    <div class="col-sm-9">
  
      <textarea name="txtworkhistory" id="workhistory" class="form-control" rows="3" placeholder="*Lưu ý: Sử dụng ký hiệu </br> để xuống dòng
      Vd: Năm 2005: Giảng dạy tại Đại học Sư phạm </br>
      Năm 2017: Giảng dạy tại trung tâm Đức Kiến"></textarea>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="amount">Tiền ban đầu:</label>
    <div class="col-sm-9">
       <div class="input-group">
      
     
       <input type="number" class="form-control" value="0" ng-required="true"  name="txtamount" id="amount" placeholder="Vui lòng nhập số tiền">
      <div class="input-group-addon">.VND</div>
    </div>
     

    </div>
  </div>

            <div class="form-group">
    <label class="control-label col-sm-3" for="fileimage">Hình đại diện:</label>
    <div class="col-sm-9">
  <input type="file"  required="true" name="fileimage" id="fileimage">
     
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
 <script src="<?php echo asset('public/app/controller/admins/TeacherController.js') ; ?>"></script> 
             <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'workhistory' );
            </script>
@endsection
