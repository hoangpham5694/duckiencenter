@extends('admin.master')
@section('header')
<title>Admin::Chi tiết buổi học {{ $attendance->name }}</title>
@endsection
@section('title')
Chi tiết buổi học {{ $attendance->name }}
@endsection
@section('content')
<div ng-controller="DetailAttendanceController">
  <div class="row teacher-info" data-ng-init="getAttendance({{ $attendance->id }})">

    <div class="col-sm-8 info">
      <table>
        <tr>
          <td>
           <strong>Buổi học:</strong>
         </td>
         <td>
           {{ $attendance->name }}
         </td>
       </tr> 
       <tr>
        <td>
         <strong>Thời gian học:</strong>
       </td>
       <td>
        <?php \Carbon\Carbon::setLocale('vi');?>
        {!! \Carbon\Carbon::createFromTimeStamp(strtotime($attendance->study_date))->diffForHumans() !!}
      </td>
    </tr> 
    <tr>
      <td>
       <strong>Lớp:</strong>
     </td>
     <td>
      {{ $attendance->course_name }}
    </td>
  </tr> 
  <tr>
    <td>
     <strong>Học phí:</strong>
   </td>
   <td>

    {{number_format($attendance->fee,0)  }} VND
  </td>
</tr>
<tr>
  <td>
   <strong>Tổng học viên:</strong>
 </td>
 <td> {% attendance.total_students%} </td>
</tr>

<tr>
  <td>
   <strong>Học viên nợ:</strong>
 </td>
 <td>  </td>
</tr>
<tr>
  <td>
    <strong>Trạng thái:</strong>
  </td>
  <td>  
    <span ng-if="attendance.is_taught ==0">Chưa học</span>
    <span ng-if="attendance.is_taught ==1">Đã học</span>

 </td>
</tr>





<tr>
  <td>
   <strong>Tiền thu được:</strong>
 </td>
 <td> {% attendance.money | number:0%} VND </td>
</tr>
</table>



</div>
<div class="col-sm-4">
  <button class="btn btn-warning pull-right" href="#" ng-click="lockAttendance(attendanceId)" ng-disabled="attendance.is_taught ==1"><i class="fa fa-lock" aria-hidden="true"></i> Khóa</button>
 
</div>
<div class="clearfix"></div>
</div>
<hr>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#student">Học viên <span class="badge">{%totalCourseStudents%}</span></a></li>
  <li><a data-toggle="tab" href="#studentdebt">Học viên nợ <span class="badge">{%totalStudentDebts%}</span></a></li>

</ul>
<div class="tab-content">
  <div id="student"  class="tab-pane fade in active"  data-ng-init="getCourseStudentList(attendanceId)">

    <table class="table table-hover">
      <thead>
        <tr>
          <th>Mã học viên</th>
          <th>Tên</th>
          <th>Điện thoại</th>
          <th>Số dư</th>
          <th>Trạng thái</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="courseStudent in courseStudents" ng-class="{danger: courseStudent.status =='deactive' , success:courseStudent.status =='active'} ">
          <td>{% courseStudent.username %}</td>
          <td>{% courseStudent.lastname %} {% courseStudent.firstname %}</td>
          <td>{% courseStudent.phone %}</td>
          <td ng-class="{danger: courseStudent.amount < attendance.fee }">{% courseStudent.amount | number:0 %} VND
           
          </td>
          <td>
            <span ng-if="courseStudent.status =='active'">Đang học</span>
            <span ng-if="courseStudent.status =='deactive'">Đình chỉ học</span>

          </td>
          <td>
             <button class="btn btn-primary btn-xs" ng-click="modalStudentDebt(courseStudent.student_id)" >  <i class="fa fa-usd" aria-hidden="true"></i>Thanh toán</button>

          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div id="studentdebt" class="tab-pane fade" data-ng-init="getListStudentDebts(attendanceId)">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Mã học viên</th>
          <th>Tên</th>
          <th>Số nợ</th>
          <th>Số dư</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="studentDebt in studentDebts" >
          <td>{% studentDebt.username %}</td>
          <td>{% studentDebt.lastname %} {% studentDebt.firstname %}</td>
      
          <td>
          {% studentDebt.money | number:0 %} VND
          </td>

          <td>
              {% studentDebt.amount | number:0 %} VND
          </td>
          <td>

            <button class="btn btn-primary btn-xs " >  <i class="fa fa-usd" aria-hidden="true"></i>Thanh toán</button>
     

        </td>
      </tr>
    </tbody>
  </table>

</div>
</div>



<div class="modal fade bs-example-modal-lg" tabindex="-1" id="modalDebt" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Thanh toán nợ</h4>
      </div>
      <div class="modal-body">
        <ul>
          <li><strong>Học viên</strong>: {% studentDetail.lastname %} {% studentDetail.firstname %}</li>
          <li><strong>Mã học viên</strong>: {% studentDetail.username %}</li>
          <li><strong>Số dư</strong>: {% studentDetail.amount | number:0 %}VND</li>
        </ul>
        <hr>
        <table class="table table-striped">
    <thead>
                                    <tr>
                                        <th>Buổi học</th>
                                        <th>Lớp</th>
                                        <th>Tiền nợ</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="debtOfStudent in debtOfStudents"  >
                                        <td>{% debtOfStudent.name %}</td>
                                        <td>{% debtOfStudent.course_name %} </td>
                                        <td>
                                            {% debtOfStudent.money| number:0 %}VND
                                        </td>
                                      
                                  
                                        <td>
                                   
    <button class="btn btn-primary btn-xs" ng-click="removeDebt(debtOfStudent.id)"><i class="fa fa-usd" aria-hidden="true"></i>Thanh toán</button>
                                       
                                     
                                          </td>
                                    </tr>
                                </tbody>
        </table>
      </div>
      <div class="modal-footer">
  
      </div>
    </div>
  </div>
</div>

</div>








@endsection
@section('footer')

<script>

</script>
<script src="<?php echo asset('app/controller/admins/DetailAttendanceController.js') ; ?>"></script>  

@endsection
