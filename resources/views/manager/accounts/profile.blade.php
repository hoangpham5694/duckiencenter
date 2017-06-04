@extends('manager.master')
@section('header')
<title>Admin::Thông tin cá nhân</title>
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
         {{ $user->lastname }} {{ $user->firstname }}
       </td>
     </tr> 
     <tr>
      <td>
       <strong>Tên đăng nhập:</strong>
     </td>
     <td>
      {{ $user->username }}
    </td>
  </tr> 
  <tr>
    <td>
     <strong>Vai trò:</strong>
   </td>
   <td>
    {{ $user->role_name }}
  </td>
</tr> 


<tr>
  <td>
   <strong>Điện thoại:</strong>
 </td>
 <td> 
  {{ $user->phone }}
</td>
</tr>

<tr>
  <td>
   <strong>Email:</strong>
 </td>
 <td>
  {{ $user->email }}
</td>
</tr>





</table>



</div>
<div class="col-sm-4">
  <a class="btn btn-default pull-right" href="{!! url('/managersites/account') !!}/edit" role="button">Sửa thông tin</a>
</div>
<div class="clearfix"></div>
</div>


@endsection
@section('footer')

@endsection
