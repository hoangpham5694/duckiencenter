@extends('teacher.master')
@section('header')
    <title>Giáo viên::Thảo luận: {{ $thread->title }}</title>
     <script src="{!! asset('ckeditor/ckeditor.js') !!}"></script>
@endsection
@section('title')
{{ $thread->title }}
@endsection
@section('content')

<div class="row teacher-info">

  <div class="col-sm-8 info">
    <table>
      <tr>
        <td>
           <strong>Tiêu đề: </strong>
        </td>
        <td> {{ $thread->title }} </td>
      </tr> 
       <tr>
        <td>
           <strong>Người đăng: </strong>
        </td>
        <td> 
          <?php 
            switch($thread->type){
              case "t":
                echo $thread->teacher_lastname." ".$thread->teacher_firstname." (Giáo viên)";
              break;
              case "s":
                echo $thread->student_lastname." ".$thread->student_firstname." (Học viên)";
              break;
            }
          ?>

        </td>
      </tr> 
  
            
       <tr>
        <td>
           <strong>Thời gian: </strong>
        </td>
        <td> 
 <?php \Carbon\Carbon::setLocale('vi');?>
         {!! \Carbon\Carbon::createFromTimeStamp(strtotime($thread->created_at))->diffForHumans() !!}
         </td>
      </tr>

  
        
    </table>



  </div>
  <div class="clearfix"></div>
</div>

<hr>
<div class="teacher-sumary">

{!! $thread->content !!}

</div>
<hr>
<div class="list-comment">
  

</div>
<hr>
<div class="rep-comment">
  <h4>Bình luận</h4>
  <form>
                <div class="form-group">
   

  
      <textarea name="txtContent" id="comment" class="form-control" rows="8" ></textarea>
  
  </div>
    <div class="form-group">
    <div class="col-sm-offset-4 col-sm-4">
      <button type="submit" class="btn btn-primary btn-md btn-block">Bình luận</button>
    </div>
  </div>

  </form>

</div>
@endsection
@section('footer')
    <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'comment' );
            </script>
@endsection
