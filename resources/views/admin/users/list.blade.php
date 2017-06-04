@extends('admin.master')
@section('header')
    <title>Admin::Quản lý nhân viên</title>
@endsection
@section('title','Quản lý nhân viên')
@section('content')
<div ng-controller="UserController" data-ng-init="getlistuser(1)">
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
    <label for="inputEmail3" class="col-sm-3 control-label">Sắp xếp theo:</label>
    <div class="col-sm-4">
      <select name="" ng-model="orderby" class="form-control" ng-change="changeOrderBy()" id="">
        <option value="id">Số thứ tự</option>
          <option value="username">Tên đăng nhập</option>
          
          <option value="firstname">Họ</option>
           <option value="lastname">Tên</option>
          <option value="role">Vai trò</option>
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
                                <input type="text" ng-model="keyword" ng-change="changeKey()" class="form-control" placeholder="Nhập Tên, Username ">
                                 <span class="input-group-addon" id="sizing-addon2"> <i class="fa fa-search"></i></span>
                                
                            </div>
        </div>
    </div>
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Tên đăng nhập</th>
                              
                                        <th>Tên</th>
                              
                                        <th>Vai trò</th>
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <tr ng-repeat="user in users">
                                    <td>{% user.username %}</td>
                               
                                        <td>{% user.lastname %} {% user.firstname %}</td>
                              
                                    <td>{% user.role %}</td>
                          
                                    <td>
                                   <a class="btn btn-xs btn-primary" href="{!! url('adminsites/user/edit') !!}/{%user.id%}" >
                                         <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Sửa
                                            </a>
        <a class="btn btn-xs btn-danger" ng-click="confirmDelete(user.id)" >
                                         <i class="glyphicon glyphicon-edit" aria-hidden="true"></i> Xóa
                                            </a>
  
                                     </td>
                                  </tr>
                                </tbody>
</table>

<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
  	<button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="getlistuserspage(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>

@endsection
@section('footer')
  <script src="<?php echo asset('app/controller/admins/ListUsersController.js') ; ?>"></script>  
@endsection
