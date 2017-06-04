@extends('guest.master')
@section('header')
    <title>Thông tin lớp học</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div class="post-title">
	<h2>Thông tin lớp học</h2>

	<div class="clearfix"></div>
</div>
<div class="post-main" ng-controller="DetailCourseController">
	<div class="description">
    <div class="info-course">
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
            <li>
              Lịch học: {{ $course->description }}
            </li>

        </ul>  
    </div>
  <hr>
		<div class="clearfix"></div>
	</div>
	<div class="content">
		<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#student">Học viên</a></li>
    <li><a data-toggle="tab" href="#attendance">Buổi học</a></li>

  </ul>
		  <div class="tab-content">
  <div id="student"  class="tab-pane fade in active"  data-ng-init="getliststudents({{ $course->id }})">

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
                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('thong-tin-hoc-vien') !!}/{% student.student_id %}">
                                                <i class="fa fa-address-card" aria-hidden="true"></i> Chi tiết
                                            </a>

                                          </td>
                                    </tr>
                                </tbody>
</table>
</div>
  <div id="attendance" class="tab-pane fade" data-ng-init="getListAttendances({{ $course->id }})">

    <table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Buổi học</th>
                                        <th>Giáo viên dạy</th>
                                        <th>Tình trạng</th>

  
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
                                      
                        
                                    </tr>
                                </tbody>
</table>

  </div>
</div>
	</div>
</div>
@endsection

@section('footer')
  <script src="<?php echo asset('app/controller/guests/DetailCourseController.js') ; ?>"></script>  
@endsection
