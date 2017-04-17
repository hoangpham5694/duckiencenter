@extends('admin.master')
@section('header')
    <title>Admin::Quản lý học phí</title>
@endsection
@section('title')
Học phí lớp {{ $course->name }}
@endsection
@section('content')
<div class="panel panel-default" ng-controller="FeeController" data-ng-init="getlistmonths({{ $course->id }})">
  <div class="panel-body">
    <div class="col-sm-7 info-course">
        <ul>
            <li>
                Mã lớp: {{ $course->id }}
            </li>           
             <li>
                Tên lớp: {{ $course->name }}
            </li>
                         <li>
                Giáo viên: {{ $course->teacher_name }}
            </li>
                         <li>
                Chi nhánh: {{ $course->agency_name }}
            </li>
                         <li>
                Học phí: {% feeMonthly %}
            </li>

        </ul>  
    </div>
  </div>
  <div >
<div class="row">
  <div class="col-sm-3">
    <form>
  <div class="form-group">
    <label for="selectMonths">Chọn tháng học</label>
<select  ng-options="month.id as month.name for month in months track by month.id" ng-change="getStudentInMonth(selectmonth)" class="form-control" ng-model="selectmonth">
   
</select>

  </div>

</form>
  </div>
  <div class="col-sm-3"></div>
  <div class="col-sm-3"></div>
  <div class="col-sm-3">
    <button class="btn btn-primary " ng-click="refreshMonth({{ $course->id }})"><i class="fa fa-refresh" aria-hidden="true"></i> Cập nhật tháng </button>
    <button class="btn btn-primary " ng-show="courseMonthlyId != null" ng-click="refreshStudentMonthly({{ $course->id }}, courseMonthlyId)"><i class="fa fa-refresh" aria-hidden="true"></i> Cập nhật học viên của tháng </button>
  </div>

  </div>
</div>  

<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã học viên</th>
                                        <th>Họ lót</th>
                                        <th>Tên</th>
                                     
                                        <th>Nộp tiền</th>
                          
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="student in students" ng-class="{danger: student.is_fee ==0 , success:student.is_fee ==1} " >
                                        <td>{% student.username %}</td>
                                        <td >{% student.lastname %}</td>
                                        <td>{% student.firstname %}</td>
                                      
                                        <td>
                                            <span ng-if="student.is_fee ==0">Chưa nộp</span>
                                            <span ng-if="student.is_fee ==1">Đã nộp</span>
                                        </td>
                                   
                                        <td>
                                        
    <button class="btn btn-primary btn-xs " ng-hide="student.is_fee ==1" ng-click="">  <i class="fa fa-usd" aria-hidden="true"></i> Nộp tiền </button>
                                          </td>
                                    </tr>
                                </tbody>
</table>
</div>


<div class="modal fade" id="modal-add" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Lập hóa đơn</h4>
      </div>
      <div class="modal-body">
<form action="" class="form-horizontal">
   
</form>



      </div>
 <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</div>

@endsection
@section('footer')
  <script src="<?php echo asset('public/app/controller/admins/FeeController.js') ; ?>"></script>  
@endsection
