@extends('manager.master')
@section('header')
    <title>Manager::Thanh toán lương</title>
@endsection
@section('title','Thanh toán lương giáo viên')
@section('content')
<div ng-controller="TeacherController" data-ng-init="getlistteacher(1)">
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Sắp xếp theo:</label>
    <div class="col-sm-4">
      <select name="" ng-model="orderby" class="form-control" ng-change="changeOrderBy()" id="">
          <option value="username">Mã giáo viên</option>
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
                                           <a class="btn btn-xs btn-primary" ng-href="{!! url('managersites/payout/add') !!}/{% teacher.id %}">
                                        <i class="fa fa-credit-card-alt" aria-hidden="true"> </i> Thanh toán
                                      </a>
                                            </a>

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
  <script src="<?php echo asset('public/app/controller/managers/TeacherController.js') ; ?>"></script>  
@endsection
