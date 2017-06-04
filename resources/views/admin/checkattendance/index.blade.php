@extends('admin.master')
@section('header')
    <title>Admin::Kiểm tra buổi học</title>
@endsection
@section('title','Kiểm tra buổi học')
@section('content')
<div ng-controller="CheckAttendanceController" data-ng-init="getListAttendances()">
    <div class="row">
        <div class="col-sm-6">
          <form class="form-horizontal"> 
           <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label">Hiển thị:</label>
            <div class="col-sm-6">
              <select name="" ng-model="isTaught" ng-change="changeIsTaught()" class="form-control"  id="">
                <option value="">Tất cả</option>
                <option value="0">Chưa học</option>
                <option value="1">Đã học</option>
              </select>
            </div>

          </div>
        </form>
       
        </div>
        <div class="col-sm-6">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-5 control-label">Ngày học:</label>
              <div class="col-sm-7">
                <input type="date" ng-model="studyDate" ng-change="changeStudyDate()" class="form-control" id="" placeholder="">
              </div>
            </div>

          </form>
      
        </div>
    </div>
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã lớp</th>
                                        <th>Lớp</th>
                                        <th>Giáo viên</th>
                                        <th>Tình trạng</th>
                                        <th></th>
                                        
                      
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr ng-repeat="attendance in attendances" ng-class="{warning: attendance.is_taught ==0 , success:attendance.is_taught ==1} ">
                                		<td>{% attendance.course_id%}</td>
                                		<td>{% attendance.course_name%}</td>
                                        <td>{% attendance.teacher_lastname%} {% attendance.teacher_firstname%}</td>
                                		<td >
                                     <span ng-if="attendance.is_taught ==0">Chưa học</span>
                                     <span ng-if="attendance.is_taught ==1">Đã học</span>
                                    </td>
                                	
                          
                                		<td>
                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/check-attendance/detail') !!}/{% attendance.id %}">
                                                <i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Kiểm tra
                                            </a>
    
                                          </td>
                                	</tr>
                                </tbody>
</table>



@endsection
@section('footer')
  <script src="<?php echo asset('app/controller/admins/CheckAttendanceController.js') ; ?>"></script>  
@endsection
