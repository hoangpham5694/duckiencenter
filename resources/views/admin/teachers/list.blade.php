@extends('admin.master')
@section('header')
    <title>Admin::Danh sách giáo viên</title>
@endsection
@section('title','Danh sách giáo viên')
@section('content')
<div ng-controller="TeacherController">
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Họ</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Điện thoại</th>
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr ng-repeat="teacher in teachers">
                                		<td>{% teacher.username %}</td>
                                		<td>{% teacher.lastname %}</td>
                                        <td>{% teacher.firstname %}</td>
                                		<td>{% teacher.email %}</td>
                                		<td>{% teacher.phone %}</td>
                          
                                		<td>
                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/teacher/edit') !!}/{% teacher.id %}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
    <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(teacher.id)">  <i class="fa fa-trash" aria-hidden="true"></i></button>
                                          </td>
                                	</tr>
                                </tbody>
</table>

<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
  	<button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="getlistteacher(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>

@endsection
@section('footer')
  <script src="<?php echo asset('public/app/controller/admins/TeacherController.js') ; ?>"></script>  
@endsection
