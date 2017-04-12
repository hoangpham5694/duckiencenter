@extends('admin.master')
@section('header')
    <title>Admin::Quản lý học phí</title>
@endsection
@section('title','Quản lý học phí')
@section('content')
<div ng-controller="CourseController">

<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã lớp</th>
                                        <th>Tên</th>
                                    
                                        <th>Học phí</th>
                                        <th>Chi nhánh</th>
                                        <th>Giáo viên</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr ng-repeat="course in courses">
                                		<td>{% course.id %}</td>
                                		<td>{% course.name %}</td>
                               
                                		<td>{% course.fee %}</td>
                                		<td>{% course.agency_name %}</td>
                                        <td>{% course.teacher_name %}</td>
                                		<td>
                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/course/edit') !!}/{% course.id %}">
                                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                            </a>

                                          </td>
                                	</tr>
                                </tbody>
</table>

<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
  	<button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="getlistcourses(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>

@endsection
@section('footer')
  <script src="<?php echo asset('public/app/controller/admins/CourseController.js') ; ?>"></script>  
@endsection
