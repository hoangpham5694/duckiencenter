@extends('admin.master')
@section('header')
    <title>Admin::Danh sách tin</title>
@endsection
@section('title','Danh sách tin')
@section('content')
<div ng-controller="NewsController">
        <div class="row" data-ng-init="getListCates()">
        <div class="col-sm-4">
            <div class="form-group">
    <label for="inputEmail3" class="col-sm-4 control-label">Danh mục:</label>
    <div class="col-sm-8">
      <select name="" ng-model="sltCate" class="form-control" ng-change="changeCate()" id="">
          <option value="">Tất cả</option>
       <option ng-repeat="cate in cates" value="{%cate.id%}">{%cate.name%} </option>
      </select>
    </div>
       
  </div>
        </div>
        <div class="col-sm-4">
        
        </div>
        <div class="col-sm-4">
            <div class="input-group custom-search-form">
                                <input type="text" ng-model="txtKeyword" ng-change="changeKey()" class="form-control" placeholder="Nhập tiêu đề ">
                                 <span class="input-group-addon" id="sizing-addon2"> <i class="fa fa-search"></i></span>
                                
                            </div>
        </div>
    </div>
   
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã lớp</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên</th>
                                        <th>Danh mục</th>
                                        <th>Ngày đăng</th>
                                       
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr ng-repeat="news in newss">
                                		<td>{% news.id %}</td>
                                		<td><img ng-src="{!! asset('upload/newsimages') !!}/{% news.image %}" width="60px" height="60px" alt=""></td>
                                		<td>{% news.title %}</td>
                                    <td>{% news.name %}</td>
                                		<td>{% news.created_at %}</td>
        
                                		<td>
                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/news/detail') !!}/{% news.id %}">
                                                <i class="fa fa-address-card" aria-hidden="true"></i>Chi tiết </a>

                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/news/edit') !!}/{% news.id %}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa
                                            </a>
    <button ng-show="news.cate_id !=1" class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(news.id)">  <i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
                                          </td>
                                	</tr>
                                </tbody>
</table>

<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
  	<button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="changePage(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>

@endsection
@section('footer')
  <script src="<?php echo asset('app/controller/admins/NewsController.js') ; ?>"></script>  
@endsection
