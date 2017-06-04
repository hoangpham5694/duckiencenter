@extends('student.master')
@section('header')
<title>Học viên::Danh sách lớp {{ $course->name }}</title>
@endsection
@section('title')
Danh sách lớp {!! $course->name !!}
@endsection
@section('content')
<div class="panel panel-default" ng-controller="CourseDetailController" data-ng-init="getliststudents({{ $course->id }})">
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
          Lịch học: {{ $course->description }}
        </li>
        <li>
          Học viên: {% total %}/{{ $course->max_students }}
        </li>

      </ul>  
    </div>
  </div>
  <hr>
  

  <div >


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
            <!--
            <a class="btn btn-xs btn-primary" ng-href="{!! url('teachersites/student/detail') !!}/{% student.student_id %}">
              <i class="fa fa-address-card" aria-hidden="true"></i> Chi tiết
            </a>
-->
          </td>
        </tr>
      </tbody>
    </table>
  </div>





</div>





@endsection
@section('footer')

<script>

</script>
<script src="<?php echo asset('public/app/controller/students/CourseDetailController.js') ; ?>"></script>  

@endsection
