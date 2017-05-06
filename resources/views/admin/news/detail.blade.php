@extends('admin.master')
@section('header')
    <title>Admin::Chi tiết Tin</title>
@endsection
@section('title','Chi tiết Tin')
@section('content')

<div class="row teacher-info">
  <div class="col-sm-4 image">
    <img src="{!! asset('public/upload/newsimages')!!}/{{  $news->image}}" alt="">
  </div>
  <div class="col-sm-8 info">
    <table>
      <tr>
        <td>
           <strong>Tiêu đề:</strong>
        </td>
        <td> {{ $news->title }} </td>
      </tr> 
 
      <tr>
        <td>
           <strong>Chuyên mục:</strong>
        </td>
        <td> {{ $news->name }} </td>
      </tr>
            
       <tr>
        <td>
           <strong>Ngày đăng:</strong>
        </td>
        <td> 
 <?php \Carbon\Carbon::setLocale('vi');?>
        {!! \Carbon\Carbon::createFromTimeStamp(strtotime($news->created_at))->diffForHumans() !!}
         </td>
      </tr>

  
        
    </table>



  </div>
  <div class="clearfix"></div>
</div>
<div class="row">
  <div class="col-sm-12">
    <p>
       <b> {{ $news->description }}</b>
    </p>
   
  </div>
  
 
</div>
<hr>
<div class="teacher-sumary">

{!! $news->content !!}

</div>
@endsection
@section('footer')
 
@endsection
