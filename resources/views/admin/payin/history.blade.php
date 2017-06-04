@extends('admin.master')
@section('header')
    <title>Admin::Lịch sử thu học phí</title>
@endsection
@section('title','Lịch sử thu học phí')
@section('content')
<div ng-controller="PayinHistoryController" data-ng-init="getListPayins()">
    <div class="row">
               <div class="col-sm-4">
 <div class="form-group">
    <label class="sr-only" for="exampleInputEmail3">Từ ngày</label>
    <input type="date" class="form-control"  ng-model="dateBegin" ng-change="changeDateBegin()" id="exampleInputEmail3" placeholder="Từ ngày">
  </div>
        </div>
                <div class="col-sm-4">
 <div class="form-group">
    <label class="sr-only" for="exampleInputEmail3">Đến ngày</label>
    <input type="date" class="form-control"  ng-model="dateEnd" ng-change="changeDateEnd()" id="exampleInputEmail3" placeholder="Đến ngày">
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
                                        <th>Mã hóa đơn</th>
                                        <th>Học viên</th>
                                        <th>Số tiền nạp</th>
                                        <th>Số tiền cộng vào</th>
                                        <th>Số sư sau khi nạp</th>
                                        <th>Ngày nộp</th>
                                       
                                        
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr ng-repeat="payin in payins">
                                		<td>{%payin.id%}</td>
                                		<td>{%payin.lastname%} {%payin.firstname%}</td>
                                    <td>{%payin.real_money| number:0%} VND</td>
                                		<td>{%payin.virtual_money| number:0%} VND</td>
                                    <td>{%payin.amount| number:0%} VND</td>
                                		<td>{%payin.created_at%}</td>
                          
                                		<td>
                                      
                                      <a class="btn btn-xs btn-primary" ng-href="{!! url('adminsites/payin/detail') !!}/{% payin.id %}">
                                        Chi tiết
                                      </a>

                                         
                                          </td>
                                	</tr>
                                </tbody>
</table>

<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
  	<button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="getliststudent(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>

@endsection
@section('footer')
  <script src="<?php echo asset('app/controller/admins/PayinHistoryController.js') ; ?>"></script>  
@endsection
