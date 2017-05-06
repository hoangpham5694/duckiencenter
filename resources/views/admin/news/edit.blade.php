@extends('admin.master')
@section('header')
    <title>Admin::Sửa bài viết</title>
   <script src="{!! asset('public/ckeditor/ckeditor.js') !!}"></script>  
<!-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>  -->
@endsection
@section('title','Sửa bài viết')
@section('content')

<div class="col-md-9" >
	<form name="frmTeacher" action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Tiêu đề:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required="true" name="txtTitle" id="lastname" placeholder="Vui lòng nhập tiêu đề" value="{{ $news->title }}">

    </div>
  </div>
    
 
 
   <div class="form-group">
    <label class="control-label col-sm-3" for="salarylevel">Danh mục:</label>
    <div class="col-sm-9">
    <select class="form-control" id="salarylevel" name="sltCate">
         @foreach($cates as $cate)
            @if($cate->id == $news->cate_id)
                <option value="{{ $cate->id }}" selected>{{ $cate->name }}</option>
            @else
                 <option value="{{ $cate->id }}">{{ $cate->name }}</option>
            @endif
          
         @endforeach
    </select>

    </div>
  </div>
     <div class="form-group">
    <label class="control-label col-sm-3" for="fileimage">Hình bài viết:</label>
    <div class="col-sm-9">
      <img src="{!! asset('public/upload/newsimages') !!}/{!!  $news->image  !!}" height="120px" width="120px"alt="">
  <input type="file"  name="fileImage" id="fileimage">
     
    </div>
  </div>


      <div class="form-group">
    <label class="control-label col-sm-3" for="description">Mô tả:</label>
    <div class="col-sm-9">

        <textarea name="txtDescription" id="description" class="form-control" rows="3" >{!!  $news->description  !!}
        </textarea>

    </div>
  </div>
     
          <div class="form-group">
    <label class="control-label col-sm-3" for="content">Nội dung:</label>
    <div class="col-sm-9">
  
      <textarea name="txtContent" id="content" class="form-control" rows="8" >
         {!!  $news->content  !!}
      </textarea>
    </div>
  </div>
    

       



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" class="btn btn-default">Sửa bài viết</button>
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
