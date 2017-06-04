@extends('admin.master')
@section('header')
    <title>Admin::Thêm bài viết</title>
    <script src="{!! asset('ckeditor/ckeditor.js') !!}"></script>
@endsection
@section('title','Thêm bài viết')
@section('content')

<div class="col-md-7" >
	<form name="frmTeacher" action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Tiêu đề:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required="true" name="txtTitle" id="lastname" placeholder="Vui lòng nhập tiêu đề">

    </div>
  </div>
    
 
 
   <div class="form-group">
    <label class="control-label col-sm-3" for="salarylevel">Danh mục:</label>
    <div class="col-sm-9">
    <select class="form-control" id="salarylevel" name="sltCate">
         @foreach($cates as $cate)
           <option value="{{ $cate->id }}">{{ $cate->name }}</option>
         @endforeach
    </select>

    </div>
  </div>
     <div class="form-group">
    <label class="control-label col-sm-3" for="fileimage">Hình bài viết:</label>
    <div class="col-sm-9">
  <input type="file"  name="fileImage" id="fileimage">
     
    </div>
  </div>


      <div class="form-group">
    <label class="control-label col-sm-3" for="description">Mô tả:</label>
    <div class="col-sm-9">

        <textarea name="txtDescription" id="description" class="form-control" rows="3" ></textarea>

    </div>
  </div>
     
          <div class="form-group">
    <label class="control-label col-sm-3" for="content">Nội dung:</label>
    <div class="col-sm-9">
  
      <textarea name="txtContent" id="content" class="form-control" rows="8" ></textarea>
    </div>
  </div>
    

       



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" ng-disabled="frmTeacher.$invalid"  class="btn btn-default">Thêm bài viết</button>
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
