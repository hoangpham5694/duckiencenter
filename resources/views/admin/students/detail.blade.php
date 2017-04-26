@extends('admin.master')
@section('header')
    <title>Admin::Thông tin Học viên</title>
@endsection
@section('title','Thông tin Học viên')
@section('content')

<div class="row teacher-info">

  <div class="col-sm-8 info">
    <table>
      <tr>
        <td>
           <strong>Họ tên:</strong>
        </td>
        <td>
          {{ $student->lastname }} {{ $student->firstname }}
         </td>
      </tr> 
      <tr>
        <td>
           <strong>Giới tính:</strong>
        </td>
        <td>
            @if($student->gender == "male")
              {{ "Nam" }}
            @elseif($student->gender == "female")
             {{ "Nữ" }}
            @else
              {{ "khác"  }}
            @endif
         </td>
      </tr> 
        <tr>
        <td>
           <strong>Ngày sinh:</strong>
        </td>
        <td>
              {{ Carbon\Carbon::parse($student->dob)->format('d/m/Y') }}
         </td>
      </tr> 
        <tr>
        <td>
           <strong>Quốc tịch:</strong>
        </td>
        <td> {{ $student->name }} </td>
      </tr>

      <tr>
        <td>
           <strong>Điện thoại:</strong>
        </td>
        <td> {{ $student->phone }} </td>
      </tr>
          <tr>
        <td>
           <strong>Điện thoại Phụ huynh:</strong>
        </td>
        <td> {{ $student->parents_phone }} </td>
      </tr>
            <tr>
        <td>
           <strong>Email:</strong>
        </td>
        <td> {{ $student->email }} </td>
      </tr>
   


         <tr>
        <td>
           <strong>Địa chỉ:</strong>
        </td>
        <td>{{ $student->address }} </td>
      </tr>
               <tr>
        <td>
           <strong>Số dư:</strong>
        </td>
        <td> {{number_format($student->amount ,0)  }} VND </td>
      </tr>
    </table>



  </div>
  <div class="col-sm-4">
    <a class="btn btn-default pull-right" href="#" role="button">In thông tin</a>
  </div>
  <div class="clearfix"></div>
</div>
<hr>
<div class="teacher-sumary" ng-controller="DetailStudent">
    <h3>Các lớp đang học</h3>
<button type="button" class="btn btn-outline btn-primary" data-toggle="modal" ng-click="modalAdd()">Thêm lớp</button>
<table class="table table-hover" data-ng-init="getListCoursesOfStudent( {{ $student->id }})">
<thead>
  <tr>
      <th>
    Mã lớp
  </th>  <th>
    Tên lớp
  </th>
   <th>
    Học phí
  </th>
   <th>
    Giáo viên
  </th>
  <th>
    
  </th>
  </tr>


</thead>
<tbody>

    <tr ng-repeat="course in courses">
      <td>
     
       {% course.id%}

      </td>
      <td>
       {% course.name%}
      </td>
            <td>
        {% course.fee | number:0%}VND
      </td>
            <td>
    {% course.teacher_lastname%} {% course.teacher_firstname%}
      </td>
    </tr>

</tbody>
</table>

<div class="modal fade bs-example-modal-lg" tabindex="-1" id="modalCourse" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Đăng kí lớp học</h4>
      </div>
      <div class="modal-body">
      <div class="row">
        <div class="col-sm-6">
          <form class="form-horizontal">
            <div class="form-group">
              <label for="selectAgencies" class="col-sm-3 control-label">Nhóm lớp:</label>
              <div class="col-sm-9">
                <select ng-model="selectAgecies" ng-change="changeAgency(selectAgecies)" class="form-control" id="selectAgencies">
                   <option ng-repeat="option in agencies" value="">--Chọn nhóm lớp--</option>
                  <option ng-repeat="option in agencies" value="{%option.id%}">{%option.name%}</option>
                </select>
              </div>
            </div>
          </form>
        </div>
      </div>
        <hr>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Mã</th>
              <th>Lớp</th>
              <th>Học phí</th>

              <th>Giáo viên</th>
              <th>Lịch học</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="course in allCourses"  >
              <td>{%course.id%}</td>
              <td>{%course.name%} </td>
              <td>
               {%course.fee | number:0%}VND
              </td>
              <td>
                {%course.teacher_lastname%} {%course.teacher_firstname%}
              </td>


              <td>

                <button class="btn btn-primary btn-xs" ng-click="acceptCourse(course.id,studentId)">Đăng kí</button>


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
   <script src="<?php echo asset('public/app/controller/admins/DetailStudentController.js') ; ?>"></script>  
@endsection
