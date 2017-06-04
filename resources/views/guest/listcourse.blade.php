@extends('guest.master')
@section('header')
    <title>Danh sách lớp học</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div ng-controller="ListCourseController">
	<div class="cate-name">
	<h2>Dánh sách lớp học</h2>
</div>

<div class="list-post" data-ng-init="getListStudent(); ">
       <div class="row" data-ng-init="getListTeachers(); getListAgencies()">
        <div class="col-sm-4">
            <div class="form-group">
    <label for="inputEmail3" class="col-sm-5 control-label">Giáo viên:</label>
    <div class="col-sm-7">
      <select name="" ng-model="sltTeacher" class="form-control" ng-change="changeTeacher()" id="">
          <option value="">Tất cả</option>
       <option ng-repeat="teacher in teachers" value="{%teacher.id%}">{%teacher.lastname%} {%teacher.firstname%}</option>
      </select>
    </div>
       
  </div>
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
                                <input type="text" ng-model="txtKeyword" ng-change="changeKey()" class="form-control" placeholder="Nhập Tên lớp học">
                                 <span class="input-group-addon" id="sizing-addon2"> <i class="fa fa-search"></i></span>
                                
                            </div>
        </div>
        <div class="clearfix"></div>
    </div>
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã lớp</th>
                                        <th>Tên</th>
                                        <th>HV tối đa</th>
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
                                    <td>{% course.max_students %}</td>
                                    <td>{% course.fee %}</td>
                                    <td>{% course.agency_name %}</td>
                                        <td>{% course.teacher_lastname %} {% course.teacher_firstname %}</td>
                                    <td>
                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('thong-tin-lop-hoc') !!}/{% course.id %}">
                                                <i class="fa fa-address-card" aria-hidden="true"></i> Chi tiết </a>

                                  
                                          </td>
                                  </tr>
                                </tbody>
</table>

</div>
  <div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
    <button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="getlistcourses(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>    

</div>

@endsection

@section('footer')
  <script src="<?php echo asset('app/controller/guests/ListCourseController.js') ; ?>"></script>  
@endsection
