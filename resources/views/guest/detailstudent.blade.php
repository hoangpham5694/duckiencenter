@extends('guest.master')
@section('header')
    <title>Thông tin học viên</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div class="post-title">
	<h2>Thông tin học viên</h2>

	<div class="clearfix"></div>
</div>
<div class="post-main" ng-controller="DetailStudent">
	<div class="description">
  <div class="info">
    <table>
    	      <tr>
        <td>
           <strong>Mã học viên:</strong>
        </td>
        <td>
          {{ $student->username }} 
         </td>
      </tr> 
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
  <hr>
		<div class="clearfix"></div>
	</div>
	<div class="content">
		 <h4>Các lớp đang học</h4>
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

  </tr>


</thead>
<tbody>

    <tr ng-repeat="course in courses">
      <td>
     
       {% course.course_id%}

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
	</div>
</div>
@endsection

@section('footer')
  <script src="<?php echo asset('app/controller/guests/DetailStudentController.js') ; ?>"></script>  
@endsection
