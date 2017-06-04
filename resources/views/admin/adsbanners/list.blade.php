@extends('admin.master')
@section('header')
    <title>Admin::Danh sách Banner</title>
@endsection
@section('title','Danh sách Banner')
@section('content')
<div ng-controller="AdsController">
        <div class="row" data-ng-init="getListAds()">
<div class="col-sm-4"></div>
        <div class="col-sm-4">
        
        </div>
        <div class="col-sm-4">
            <div class="input-group custom-search-form">
                                <input type="text" ng-model="txtKeyword" ng-change="changeKey()" class="form-control" placeholder="Nhập tiêu đề ">
                                 <span class="input-group-addon" id="sizing-addon2"> <i class="fa fa-search"></i></span>
                                
                            </div>
        </div>
        <div class="clearfix"></div>
    </div>
   
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        
                                        <th>Hình ảnh</th>
                                        <th>Tên</th>
                                        <th>Đường dẫn</th>
                           
                                       
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr ng-repeat="ads in adss">
                                	
                                		<td><img ng-show="true" ng-src="{!! asset('public/upload/adsimages') !!}/{% ads.image %}" width="60px" height="60px" alt=""></td>
                               
                                    <td>{% ads.name %}</td>
                                		<td>{% ads.url %}</td>
        
                                		<td>
  

                                            <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/ads/edit') !!}/{% ads.id %}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sửa
                                            </a>
    <button ng-show="news.cate_id !=1" class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(ads.id)">  <i class="fa fa-trash" aria-hidden="true"></i> Xóa</button>
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
  <script src="<?php echo asset('app/controller/admins/AdsController.js') ; ?>"></script>  
@endsection
