@extends('student.master')
@section('header')
<title>Học viên::Thông tin cá nhân</title>
@endsection
@section('title','Thông tin cá nhân')
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
       <strong>Mã học viên:</strong>
     </td>
     <td>
      {{ $student->username }}
    </td>
  </tr> 
 


<tr>
  <td>
   <strong>Điện thoại:</strong>
 </td>
 <td> 
  {{ $student->phone }}
</td>
</tr>
<tr>
  <td>
   <strong>Điện thoại phụ huynh:</strong>
 </td>
 <td> 
  {{ $student->parents_phone }}
</td>
</tr>

<tr>
  <td>
   <strong>Email:</strong>
 </td>
 <td>
  {{ $student->email }}
</td>
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
  <a class="btn btn-default pull-right" href="{!! url('/studentsites/account') !!}/edit" role="button">Sửa thông tin</a>
</div>
<div class="clearfix"></div>
</div>


@endsection
@section('footer')

@endsection
