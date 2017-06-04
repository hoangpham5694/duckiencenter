@extends('admin.master')
@section('header')
    <title>Admin::Nạp tiền học thử</title>
@endsection
@section('title','Nạp tiền học thử')
@section('content')
<div class="col-md-7"  >
  <form  action=""  method="POST" enctype="multipart/form-data" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

  <div class="form-group">
    <label class="control-label col-sm-3" for="lastname">Tên học viên:</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" value="{{ $student->lastname }} {{ $student->firstname }}"  readonly="true" id="lastname"  >
      
    </div>
  </div>

    <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="username">Mã học viên:</label>
    <div class="col-sm-9">
       
   
        <input type="text" class="form-control"  value="{{ $student->username }}" readonly="true"name="txtusername" id="username">
           

  
  
    </div>
  </div>

  <div class="form-group has-feedback" id="formGroupUsername">
    <label class="control-label col-sm-3" for="virtualmoney">Số tiền nạp:</label>
    <div class="col-sm-9">  
        <input type="number" class="form-control" step="10000" required min="0" max="5000000"  name="txtTrialMoney" id="virtualmoney">
    </div>
  </div>

    



    

     
       


 



  <div class="form-group"> 
    <div class="col-sm-offset-3 col-sm-9">
      <button type="submit"   class="btn btn-default">Nạp tiền</button>
    </div>
  </div>
</form>

</div>
<div class="clearfix"></div>
@endsection
@section('footer')


@endsection
