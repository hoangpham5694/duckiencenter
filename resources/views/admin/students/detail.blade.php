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
<div class="teacher-sumary">
    <h3>Các lớp đang học</h3>
<table class="table table-hover">
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
    <tr>
      <td>
        {{ $course->id }}
       

      </td>
      <td>
        {{ $course->name }}
      </td>
            <td>
        {{ $course->fee }}
      </td>
            <td>
       {{ $course->teacher_lastname }} {{ $course->teacher_firstname }}  
      </td>
    </tr>
  @endforeach
</tbody>
</table>


</div>
@endsection
@section('footer')
 
@endsection
