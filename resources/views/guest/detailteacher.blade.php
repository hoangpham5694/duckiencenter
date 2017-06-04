@extends('guest.master')
@section('header')
    <title>Thông tin giáo viên</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div class="post-title">
	<h2>Thông tin giáo viên</h2>

	<div class="clearfix"></div>
</div>
<div class="post-main" ng-controller="DetailStudent">
	<div class="description">
  <div class="info">
  <div class="col-sm-4 image">
    <img src="{!! asset('upload/teacherimages')!!}/{{  $teacher['image']}}" alt="">
  </div>
  <div class="col-sm-6">
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
        <td> {{ $teacher['salary_level_id'] }} -  {{ $teacher['percent'] }}%</td>
      </tr>
         <tr>
        <td>
           <strong>Địa chỉ:</strong>
        </td>
        <td> {{ $teacher['address'] }} </td>
      </tr>

    </table>

  </div>



  </div>
  <hr>
		<div class="clearfix"></div>
	</div>
	<div class="content">
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
<table class="table table-hover">
                              <thead>
                                    <tr>
                                        <th>Mã lớp</th>
                                        <th>Tên</th>
                                        <th>Học viên tối đa</th>
                                        <th>Học phí</th>

                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($courses as $course)
                                  <tr >
                                    <td>
                                     
                                      {{ $course->id }}</td>
                                    <td>
   <a href="{{ url('thong-tin-lop-hoc') }}/{{ $course->id }}"> {{ $course->name }}</a>
                                    </td>
                                    <td>{{ $course->max_students }}</td>
                                    <td>{{ $course->fee }}VND</td>
                                    
          
                                  </tr>
                                  @endforeach
                                </tbody>
</table>
	</div>
</div>
@endsection

@section('footer')
  <script src="<?php echo asset('app/controller/guests/DetailStudentController.js') ; ?>"></script>  
@endsection
