@extends('guest.master')
@section('header')
    <title>Danh sách học viên</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div ng-controller="ListStudentController">
	<div class="cate-name">
	<h2>Dánh sách học viên</h2>
</div>

<div class="list-post" data-ng-init="getListStudent(); ">
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Sắp xếp theo:</label>
    <div class="col-sm-4">
      <select name="" ng-model="orderby" class="form-control" ng-change="changeOrderBy()" id="">
          <option value="username">Mã học viên</option>
          <option value="firstname">Họ</option>
          <option value="lastname">Tên</option>
      </select>
    </div>
        <div class="col-sm-4">
      <select name="" ng-model="sort" class="form-control" ng-change="changeSort()" id="">
          <option value="asc">Tăng dần</option>
          <option value="desc">Giảm dần</option>
      </select>
    </div>
  </div>
        </div>
        <div class="col-sm-4">
            <div class="input-group custom-search-form">
                                <input type="text" ng-model="keyword" ng-change="changeKey()" class="form-control" placeholder="Nhập Tên, SĐT, Email... ">
                                 <span class="input-group-addon" id="sizing-addon2"> <i class="fa fa-search"></i></span>
                                
                            </div>
        </div>
    </div>
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã</th>
                                        <th>Họ</th>
                                        <th>Tên</th>
                                        <th>Giới tính</th>
                                       
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr ng-repeat="student in students">
                                    <td>{% student.username %}</td>
                                    <td>{% student.lastname %}</td>
                                        <td>{% student.firstname %}</td>
                                    <td>{% student.gender %}</td>
                                
                          
                                    <td>
                                                    <a class="btn btn-xs btn-primary" ng-href="{!! url('thong-tin-hoc-vien') !!}/{% student.id %}">
                                              <i class="fa fa-address-card" aria-hidden="true"></i> Chi tiết
                                            </a>
                                    
                                          </td>
                                  </tr>
                                </tbody>
</table>

</div>
<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
  	<button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="changePage(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>
</div>

@endsection

@section('footer')
  <script src="<?php echo asset('app/controller/guests/ListStudentController.js') ; ?>"></script>  
@endsection
