@extends('teacher.master')
@section('header')
    <title>Giáo viên::Tạo chủ đề</title>
    <script src="{!! asset('ckeditor/ckeditor.js') !!}"></script>
@endsection
@section('title','Tạo chủ đề')
@section('content')

<div class="col-md-9" >
	<form name="frmTeacher" action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="txtTitle">Tiêu đề:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required="true"pattern=".{5,255}" name="txtTitle" id="txtTitle" placeholder="Vui lòng nhập tiêu đề">

    </div>
  </div>
    
 
     
          <div class="form-group">
    <label class="control-label col-sm-3" for="content">Nội dung:</label>
    <div class="col-sm-9">
  
      <textarea name="txtContent" id="content" minlength=20 class="form-control" rows="8" ></textarea>
    </div>
  </div>
    

       



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit"  class="btn btn-default">Tạo bài đăng</button>
    </div>
  </div>
</form>

</div>

@endsection
@section('footer')
 
             <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'content' );
            </script>
@endsection
