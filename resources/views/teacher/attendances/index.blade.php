@extends('teacher.master')
@section('header')
    <title>Giáo viên::Điểm danh</title>
@endsection
@section('title','Điểm danh')
@section('content')
<div ng-controller="AttendanceController" >

	<div class="row">
		<div class="col-sm-4">
			<form class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Lớp:</label>
    <div class="col-sm-10">
      
      <select class="form-control" ng-options="course.id as course.name for course in courses track by course.id" ng-change="getMonthlyIncourse(selectcourse)" ng-model="selectcourse" name="" id="">
      	<option value="" disabled selected>--Chọn lớp học--</option>
      </select>
    </div>
  </div>
  
</form>

		</div>
		<div class="col-sm-4">
				<form class="form-horizontal">
  <div class="form-group">
    <label class="control-label col-sm-2" for="">Tháng:</label>
    <div class="col-sm-10">
      
      <select class="form-control" 

      ng-options="monthly.id as monthly.name for monthly in monthlys track by monthly.id" ng-change="getAttendanceInMonthly(selectmonth)" ng-model="selectmonth" name="" id="">
<option value="" disabled selected>--Chọn tháng học--</option>
  </select>
    </div>
  </div>
  
</form>
		</div>
		<div class="col-sm-4">
			<button type="button" ng-show="monthlyId != null" ng-click="addAttendace(monthlyId)" class="btn btn-primary">Thêm buổi học</button>

		</div>
    <div class="clearfix"></div>
	</div>

  <div class="row">
    
  </div>


  <div class="modal fade" tabindex="-1" id="modalAttdance" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{%modalAddAttendanceTitle%}</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="">Buổi:</label>
            <div class="col-sm-10">
              <input type="text" ng-model="attendanceName" class="form-control">
          </div>
        </div>

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary">Thêm</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>

@endsection
@section('footer')
  <script src="<?php echo asset('app/controller/teachers/AttendanceController.js') ; ?>"></script>  
@endsection