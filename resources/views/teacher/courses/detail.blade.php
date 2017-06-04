@extends('teacher.master')
@section('header')
<title>Giáo viên::Danh sách lớp {{ $course->name }}</title>
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
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#student">Học viên</a></li>
    <li><a data-toggle="tab" href="#attendance">Buổi học</a></li>
    <li><a data-toggle="tab" href="#thread">Thảo luận</a></li>
    <li><a data-toggle="tab" href="#document">Tài liệu</a></li>
  </ul>


  <div class="tab-content">
    <div id="student"  class="tab-pane fade in active">

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
              <a class="btn btn-xs btn-primary" ng-href="{!! url('teachersites/student/detail') !!}/{% student.student_id %}">
                <i class="fa fa-address-card" aria-hidden="true"></i> Chi tiết
              </a>

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
 <div id="thread" class=" list-thread tab-pane fade" data-ng-init="getListThreads({{ $course->id }},1)">
  <div class="item ng-scope" ng-repeat="thread in threads" >

        <div class="col-sm-12">
          <a ng-href="{{ url('/teachersites/thread/detail/') }}/{%thread.id%}"><h4 class="ng-binding">{%thread.title%}</h4></a>
          
          <p class="ng-binding"> 
                
           </p>
        </div>
        <div class="clearfix"></div>
        <div class="date-post pull-left ng-binding">
          Người đăng: 
          <span ng-if="thread.type =='t'" class="teacher">{%thread.teacher_lastname%} {%thread.teacher_firstname%} (Giáo viên)</span>
          <span ng-if="thread.type =='s'" class="teacher">{%thread.student_lastname%} {%thread.student_firstname%} (Học viên)</span>

          ; Ngày đăng: {%thread.created_at%}</div>
        <div class="clearfix"></div>
      </div>
<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
    <button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="changePageThread(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>

 </div>
  <div id="document"  class="tab-pane fade">
    <h2>Chức năng đang trong quá trình phát triển. Vui lòng quay lại sau!</h2>
 </div>


</div>









</div>





@endsection
@section('footer')

<script>

</script>
<script src="<?php echo asset('public/app/controller/teachers/CourseDetailController.js') ; ?>"></script>  

@endsection
