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
                Giáo viên: {{ $course->teacher_name }}
            </li>
                         <li>
                Chi nhánh: {{ $course->agency_name }}
            </li>
                         <li>
                Học viên: {% total %}/{{ $course->max_students }}
            </li>

        </ul>  
    </div>
  </div>
  <div >
    
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
                                        <td>{% student.name %}</td>
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

</div>



@endsection
@section('footer')

  <script>

  </script>
  <script src="<?php echo asset('public/app/controller/admins/CourseStudentController.js') ; ?>"></script>  

@endsection
