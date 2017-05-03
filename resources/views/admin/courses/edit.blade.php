@extends('admin.master')
@section('header')
    <title>Admin::Sửa lớp học</title>
@endsection
@section('title','Sửa lớp học')
@section('content')
<div class="col-md-7"  >
    <form  action="" method="post" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="name">Tên lớp học:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required name="txtName" value="{{ $course['name'] }}" id="txtname" placeholder="Vui lòng nhập tên lớp học" >
 
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="email">Học viên tối đa:</label>
    <div class="col-sm-9">
      <input type="number" class="form-control"  required="true" name="txtMaxStudent"  placeholder="Vui lòng nhập học viên tối đa" value="{{ $course['max_students'] }}">

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="fee">Học phí:</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" value="{{ $course['fee'] }}"  name="txtFee" id="fee" placeholder="Vui lòng nhập số tiền">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3" >Chi nhánh:</label>
    <div class="col-sm-9">
    <select class="form-control" name="selectagency">
   @foreach($agencies as $agency)
        @if($agency->id == $course['agency_id'])
          <option value="{{ $agency->id }}" selected="true">{{ $agency->name }}</option>
        @else
          <option value="{{ $agency->id }}">{{ $agency->name }}</option>
        @endif
      @endforeach

</select>

    </div>
  </div>
        <div class="form-group">
    <label class="control-label col-sm-3" >Giáo viên:</label>
    <div class="col-sm-9">
    <select class="form-control" name="selectTeacher">
      @foreach($teachers as $teacher)
          @if($teacher->id == $course['teacher_id'])
            <option value="{{ $teacher->id }}" selected="true">{{ $teacher->name }}</option>
          @else
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
          @endif
          
      
      @endforeach


</select>

    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-3" for="date-start">Ngày khai giảng:</label>
    <div class="col-sm-9">
      <input type="date" class="form-control" value="{{ $course['opening_date'] }}"  name="txtOpeningDate" id="date-start" placeholder="Vui lòng nhập ngày khai giảng">

    </div>
  </div>
      <div class="form-group">
    <label class="control-label col-sm-3"  for="description">Lịch học:</label>
    <div class="col-sm-9">

 <textarea class="form-control" rows="5" name="txtDescription" id="description" placeholder="Mô tả khóa học">{{ $course['description'] }}</textarea>
    </div>
  </div>
  



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit"   class="btn btn-default">Sửa lớp học</button>
    </div>
  </div>
</form>

</div>

@endsection
@section('footer')
  <script src="<?php echo asset('public/app/controller/admins/CourseController.js') ; ?>"></script>  

@endsection
