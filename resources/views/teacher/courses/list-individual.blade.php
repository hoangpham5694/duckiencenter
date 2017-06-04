@extends('teacher.master')
@section('header')
<title>Giáo viên::Danh sách lớp đang dạy</title>
@endsection
@section('title','Danh sách lớp đang dạy')
@section('content')
<div ng-controller="CourseIndividualController">
  <div class="row" data-ng-init=" getListAgencies()">
    <div class="col-sm-4">

    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-4 control-label">Nhóm:</label>
        <div class="col-sm-8">
          <select name="" ng-model="sltAgency" class="form-control" ng-change="changeAgency()" id="">
            <option value="">Tất cả</option>
            <option value="{%agency.id%}" ng-repeat="agency in agencies">{%agency.name%}</option>
          </select>
        </div>

      </div>
    </div>
    <div class="col-sm-4">
      <div class="input-group custom-search-form">
        <input type="text" ng-model="txtKeyword" ng-change="changeKey()" class="form-control" placeholder="Nhập Tên, SĐT, Email... ">
        <span class="input-group-addon" id="sizing-addon2"> <i class="fa fa-search"></i></span>

      </div>
    </div>
  </div>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Mã lớp</th>
        <th>Tên</th>
        <th>HV tối đa</th>
        <th>Học phí</th>
        <th>Nhóm</th>
        <th>Lịch học</th>
        <th> </th>
      </tr>
    </thead>
    <tbody>
     <tr ng-repeat="course in courses">
      <td>{% course.id %}</td>
      <td>{% course.name %}</td>
      <td>{% course.max_students %}</td>
      <td>{% course.fee %}</td>
      <td>{% course.agency_name %}</td>
      <td>{% course.description %}</td>
      <td>
        <a class="btn btn-xs btn-primary" ng-href="{!! url('teachersites/course/detail') !!}/{% course.id %}">
          <i class="fa fa-address-card" aria-hidden="true"></i>Chi tiết </a>



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
 <script src="<?php echo asset('app/controller/teachers/CourseIndividualController.js') ; ?>"></script>  
 @endsection
