@extends('admin.master')
@section('header')
    <title>Admin::Sửa giáo viên</title>
@endsection
@section('title','Sửa giáo viên')
@section('content')

<div class="col-md-7"  >
	<form  action=""  method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Họ lót:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required="true" name="txtlastname" id="lastname" value="{{ $teacher['lastname'] }}" placeholder="Vui lòng nhập Họ lót">
      
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="firstname">Tên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" required="true" value="{{ $teacher['firstname'] }}" name="txtfirstname" id="firstname" placeholder="Vui lòng nhập Tên">

    </div>
  </div>

    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Email:</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" value="{{ $teacher['email'] }}" required="true" name="txtemail" id="email" placeholder="Vui lòng nhập email">

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="phone">Điện thoại:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $teacher['phone'] }}"  ng-required="true" pattern="[0-9]{9,11}" name="txtphone" id="phone" placeholder="Vui lòng nhập số điện thoại">

    </div>
  </div>
     <div class="form-group">
    <label class="control-label col-sm-3" for="degree">Trình độ:</label>
    <div class="col-sm-9">
    <select class="form-control" id="degree" name="selectdegree">
          <option <?php if( $teacher['degree'] =="Cao đẳng") echo 'selected'?> value="Cao đẳng">Cao đẳng</option>
          <option <?php if( $teacher['degree'] =="Đại học") echo 'selected'?> value="Đại học">Đại học</option>
          <option <?php if( $teacher['degree'] =="Thạc sĩ") echo 'selected'?> value="Thạc sĩ">Thạc sĩ</option>
          <option <?php if( $teacher['degree'] =="Tiến sĩ") echo 'selected'?> value="Tiến sĩ">Tiến sĩ</option>
          <option <?php if( $teacher['degree'] =="Phó giáo sư") echo 'selected'?> value="Phó giáo sư">Phó giáo sư</option>
          <option <?php if( $teacher['degree'] =="Giáo sư") echo 'selected'?> value="Giáo sư">Giáo sư</option>
</select>

    </div>
  </div>

      <div class="form-group">
    <label class="control-label col-sm-3" for="salary">Bậc lương:</label>
    <div class="col-sm-9">
    <select class="form-control" id="salary" name="selectsalarylevel">
      @foreach($salaryLevels as $salaryLevel)
        @if($salaryLevel->id == $teacher['salary_level_id'])
          <option value="{{ $salaryLevel->id }}" selected="true">{{ $salaryLevel->percent }}</option>
        @else
          <option value="{{ $salaryLevel->id }}">{{ $salaryLevel->percent }}</option>
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
    <label class="control-label col-sm-3" for="diploma">Bằng cấp:</label>
    <div class="col-sm-9">
  
      <textarea name="txtdiploma" id="diploma"   class="form-control" rows="3" placeholder="Vd: Bằng cử nhân, Bằng đại học, Tiếng anh B1....">{{ $teacher['diploma'] }}
      </textarea>
    </div>
  </div>
        <div class="form-group">
    <label class="control-label col-sm-3" for="skill">Kỹ năng:</label>
    <div class="col-sm-9">
  
      <textarea name="txtskill" id="skill" class="form-control" rows="3" placeholder="Vd: Vật lý, hóa học, anh văn...">{{ $teacher['skill'] }}</textarea>
    </div>
  </div>
          <div class="form-group">
    <label class="control-label col-sm-3" for="workhistory">Địa điểm đã công tác:</label>
    <div class="col-sm-9">
  
      <textarea name="txtworkhistory" id="workhistory" class="form-control" rows="3" placeholder="*Lưu ý: Sử dụng ký hiệu </br> để xuống dòng
      Vd: Năm 2005: Giảng dạy tại Đại học Sư phạm </br>
      Năm 2017: Giảng dạy tại trung tâm Đức Kiến">{{ $teacher['work_history'] }}</textarea>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="amount">Số tiền:</label>
    <div class="col-sm-9">
       <div class="input-group">
      
     
       <input type="number" class="form-control" value="{{ $teacher['amount'] }}" ng-required="true"  name="txtamount" id="amount" placeholder="Vui lòng nhập số tiền">
      <div class="input-group-addon">.VND</div>
    </div>
     

    </div>
  </div>


            <div class="form-group">
    <label class="control-label col-sm-3" for="fileimage">Hình đại diện:</label>
    <div class="col-sm-9">
      <img src="{!! asset('public/upload/teacherimages') !!}/{{ $teacher['image'] }}" width="100px" height="150px" alt="">
  <input type="file"   name="fileimage" id="fileimage">
     
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
    <script src="{!! asset('public/ckeditor/ckeditor.js') !!}"></script>
          <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'workhistory' , {
    language: 'en',
    uiColor: '#77909c'
});
            </script>
@endsection
