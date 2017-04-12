@extends('admin.master')
@section('header')
    <title>Admin::Danh sách tháng</title>
@endsection
@section('title','Danh sách tháng')
@section('content')
<div ng-controller="MonthController">
<a  class="btn btn-outline btn-primary" ng-click="modal('add')">Thêm tháng mới</a>
<table class="table table-hover" >
                              <thead>
                                    <tr>
                                        <th>Mã tháng</th>
                                        <th>Tháng</th>
                                        <th>Ngày tạo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<tr ng-repeat="month in months">
                                		<td>{% month.id %}</td>
                                		<td>{% month.name %}</td>
                                		<td>{% month.created_at %}</td>
                                		
                                		<td>
                                            <a class="btn btn-xs btn-primary" ng-click="modal('edit',month.id, month.name)" >
                                         <i class="glyphicon glyphicon-edit" aria-hidden="true"></i>
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


    <div class="modal fade" tabindex="-1" role="dialog" id="modalAdd">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{%modalTitle%}</h4>
      </div>
      <div class="modal-body">
 <form class="form-horizontal" name="frmMonth">
  <div class="form-group">
    <label for="inputmonth" class="col-sm-2 control-label">Tháng</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" ng-model="month" id="inputmonth" placeholder="Nhập tháng">
    </div>
  </div>


</form>


      </div>
      <div class="modal-footer">
  
        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        <button type="button" class="btn btn-primary" ng-click="confirmAddMonth(month)">Lưu</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
@endsection
@section('footer')
  <script src="<?php echo asset('public/app/controller/admins/MonthController.js') ; ?>"></script>  
@endsection
