@extends('manager.master')
@section('header')
    <title>Manager::Thông tin giáo viên</title>
@endsection
@section('title','Thông tin giáo viên')
@section('content')

<div class="row teacher-info">
  <div class="col-sm-4 image">
    <img src="{!! asset('public/upload/teacherimages')!!}/{{  $teacher['image']}}" alt="">
  </div>
  <div class="col-sm-8 info">
    <table>
      <tr>
        <td>
           <strong>Họ tên:</strong>
        </td>
        <td> {{ $teacher['lastname'] }} {{ $teacher['firstname'] }}</td>
      </tr> 
        <tr>
        <td>
           <strong>Ngày sinh:</strong>
        </td>
        <td>
        {{ Carbon\Carbon::parse($teacher['dob'])->format('d/m/Y') }}
         </td>
      </tr> 
      <tr>
        <td>
           <strong>Điện thoại:</strong>
        </td>
        <td> {{ $teacher['phone'] }} </td>
      </tr>
            <tr>
        <td>
           <strong>Email:</strong>
        </td>
        <td> {{ $teacher['email'] }} </td>
      </tr>
       <tr>
        <td>
           <strong>Trình độ:</strong>
        </td>
        <td> {{ $teacher['degree'] }} </td>
      </tr>

       <tr>
        <td>
           <strong>Bậc lương:</strong>
        </td>
        <td>Bậc {{ $teacher['salary_level_id'] }} - Tỷ lệ {{ $teacher['percent'] }}%</td>
      </tr>
         <tr>
        <td>
           <strong>Địa chỉ:</strong>
        </td>
        <td> {{ $teacher['address'] }} </td>
      </tr>
               <tr>
        <td>
           <strong>Số dư:</strong>
        </td>
        <td> {{number_format($teacher['amount'],0)  }} VND </td>
      </tr>
    </table>



  </div>
  <div class="clearfix"></div>
</div>
<hr>
<div class="teacher-sumary">
    <h3>Thông tin học vấn</h3>
<div class="row">
  <div class="col-sm-3"><strong>Bằng cấp: </strong></div>
   <div class="col-sm-9">{{ $teacher['diploma'] }}</div>
</div>
<div class="row">
  <div class="col-sm-3"><strong>Kỹ năng chuyên môn: </strong></div>
   <div class="col-sm-9">{{ $teacher['skill'] }}</div>
</div>
<div class="row">
  <div class="col-sm-3"><strong>Lịch sử công tác: </strong></div>
   <div class="col-sm-9">{!! $teacher['work_history'] !!}</div>
</div>
 <h3>Thông tin giảng dạy</h3>
<div class="row">
  <div class="col-sm-3"><strong>Các lớp đang dạy: </strong></div>
   <div class="col-sm-9">
    <ul class="courses" >
      @foreach($courses as $course)
        <li>
          {{ $course->name }}
        
      </li>
      @endforeach

    </ul>
   </div>
</div>

</div>
@endsection
@section('footer')
 
@endsection
