@extends('admin.master')
@section('header')
    <title>Admin::Thêm Banner</title>
 
@endsection
@section('title','Thêm Banner')
@section('content')

<div class="col-md-7" >
	<form name="frmTeacher" action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Tên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control"  required="true" name="txtName" id="lastname" placeholder="Vui lòng nhập tên quảng cáo">

    </div>
  </div>
    
 
 

     <div class="form-group">
    <label class="control-label col-sm-3" for="fileimage">Hình Banner:</label>
    <div class="col-sm-9">
  <input type="file"  required="true" name="fileImage" id="fileimage">
     
    </div>
  </div>


      <div class="form-group">
    <label class="control-label col-sm-3" for="url">Đường dẫn:</label>
    <div class="col-sm-9">

          <input type="url" class="form-control"  required="true" name="txtUrl" id="url" placeholder="Vui lòng nhập đường dẫn">

    </div>
  </div>
     

    

       



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit" ng-disabled="frmTeacher.$invalid"  class="btn btn-default">Thêm banner</button>
    </div>
  </div>
</form>

</div>

@endsection
@section('footer')
 
  
@endsection
