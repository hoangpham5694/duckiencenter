@extends('admin.master')
@section('header')
    <title>Admin::Danh sách lớp {{ $course->name }}</title>
@endsection
@section('title')
Danh sách lớp {!! $course->name !!}
@endsection
@section('content')
<div class="panel panel-default" ng-controller="CourseStudentController" data-ng-init="getliststudents({{ $course->id }})">
  <div class="panel-body">
    <div class="col-sm-7 info-course">
        <ul>
            <li>
                Mã lớp: {{ $course->id }}
            </li>           
             <li>
                Tên lớp: {{ $course->name }}
            </li>
                         <li>
                Giáo viên:{{ $course->teacher_lastname}} {{ $course->teacher_firstname}}
            </li>
                         <li>
                Nhóm: {{ $course->agency_name }}
            </li>
                         <li>
                Học viên: {% total %}/{{ $course->max_students }}
            </li>

        </ul>  
    </div>
  </div>
  <hr>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#student">Học viên</a></li>
    <li><a data-toggle="tab" href="#attendance">Buổi học</a></li>

  </ul>
  <div class="tab-content">
  <div id="student"  class="tab-pane fade in active">
    
    <button type="button" class="btn btn-outline btn-primary" data-toggle="modal" data-target="#modal-add">Thêm học viên</button>
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã học viên</th>
                                        <th>Tên</th>
                                        <th>Điện thoại</th>
                                        <th>ĐT phụ huynh</th>
                                        <th>Ngày nhập học</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="student in students">
                                        <td>{% student.username %}</td>
                                        <td>{% student.lastname %} {% student.firstname %}</td>
                                        <td>{% student.phone %}</td>
                                        <td>{% student.parents_phone %}</td>
                                        <td>{% student.created_at | dateFilter | date:"dd-MM-yyyy" %}</td>
                                        <td></td>
                                        <td>
                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/course/edit') !!}/">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
    <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(student.id)">  <i class="fa fa-trash" aria-hidden="true"></i></button>
                                          </td>
                                    </tr>
                                </tbody>
</table>
</div>
  <div id="attendance" class="tab-pane fade" data-ng-init="getListAttendances({{ $course->id }})">
  <button type="button" class="btn btn-outline btn-primary" ng-click="modalAttendance('add')">Thêm Buổi học</button>
    <table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Buổi học</th>
                                        <th>Giáo viên dạy</th>
                                        <th>Tình trạng</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="attendance in attendances"  ng-class="{warning: attendance.is_taught ==0 , success:attendance.is_taught ==1} ">
                                        <td>{% attendance.name %}</td>
                                        <td>{% attendance.teacher_lastname %} {% attendance.teacher_firstname %}</td>
                                        <td>
                                            <span ng-if="attendance.is_taught ==0">Chưa học</span>
                                            <span ng-if="attendance.is_taught ==1">Đã học</span>
                                        </td>
                                      
                                        <td></td>
                                        <td>
                                          <div ng-if="attendance.is_taught ==0">
                                                   <a class="btn btn-xs btn-primary" ng-click="modalAttendance('edit',attendance.id)" >
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
    <button class="btn btn-danger btn-xs btn-delete" ng-click="deleteAttendance(attendance.id)">  <i class="fa fa-trash" aria-hidden="true"></i></button>
                                          </div>
                                     
                                          </td>
                                    </tr>
                                </tbody>
</table>

  </div>
</div>
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Thêm học viên</h4>
      </div>
      <div class="modal-body">
<form action="" class="form-horizontal">
    <div class="form-group has-feedback">

    <div class="col-sm-10 col-sm-offset-1">
      <input type="text" class="form-control" ng-model="keyword" id="inputSuccess" ng-change="searchallstudents(studentCourseId, keyword)" placeholder="Nhập mã học viên, tên, email, hoặc số điện thoại ">
      <span class="glyphicon glyphicon-search form-control-feedback"></span>
    </div>
  </div>
</form>


        <table class="table" >
          <tr ng-repeat="studentNotIn in studentNotIns" >
            <td>{%studentNotIn.username%}</td>
            <td>{%studentNotIn.name%}</td>
            <td><button class="btn btn-primary btn-circle  pull-right" ng-click="addStudentToCourse(studentCourseId,studentNotIn.id)">
              <i class="glyphicon glyphicon-plus"></i>
            </button>
              <div class="clear-fix"></div>
          </td>

          </tr>
        </table>
      </div>
 <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


    <div class="modal fade" tabindex="-1" role="dialog" id="modal-attendance">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{% modalAttendanceTitle %}</h4>
      </div>
      <div class="modal-body">
 <form class="form-horizontal" name="frmAttendance">
  <div class="form-group">
    <label for="inputname" class="col-sm-2 control-label">Buổi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="txtname" ng-required="true" ng-model="nameAttendance"  id="inputname" >
      <span id="helpBlock2" class="text-danger" ng-show="frmAttendance.txtname.$error.required">Tên buổi học không được trống</span>
    </div>
  </div>
  <div class="form-group">
    <label for="inputdate" class="col-sm-2 control-label">Ngày học</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" ng-required="true"  ng-change="setName()" ng-model="studyDate" id="inputdate" >
      <span id="helpBlock2" class="text-primary" ng-show="frmAttendance.txtname.$error.required">Chọn ngày để tự động điền tên buổi học</span>
    </div>
  </div>


</form>
{% studyDate %}

      </div>
      <div class="modal-footer">
  
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" ng-disabled="frmAttendance.$invalid" ng-click="confirmAddAttendance(nameAttendance,studyDate,attendanceState)">Lưu</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>





@endsection
@section('footer')

  <script>

  </script>
  <script src="<?php echo asset('public/app/controller/admins/CourseStudentController.js') ; ?>"></script>  

@endsection
