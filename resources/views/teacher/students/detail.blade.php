@extends('teacher.master')
@section('header')
    <title>Giáo viên::Thông tin Học viên</title>
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
@foreach($courses as $course)
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
            <td>
        <button class="btn btn-danger" ng-click="deleteCourseStudent(course.id)">Rời lớp</button>
      </td> 
    </tr>
@endforeach
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
            <td>
        <button class="btn btn-danger" ng-click="deleteCourseStudent(course.id)">Rời lớp</button>
      </td> 
    </tr>

</tbody>
</table>


</div>
@endsection
@section('footer')
   <script src="<?php echo asset('public/app/controller/managers/DetailStudentController.js') ; ?>"></script>  
@endsection
