@extends('admin.master')
@section('header')
<title>Admin::Kiểm tra tài khoản</title>
@endsection
@section('title','Tài khoản trung tâm')
@section('content')

<div class="row teacher-info">

  <div class="col-sm-8 info">
    <table>
      <tr>
        <td>
         <strong>Số tiền hiện tại trong tài khoản:</strong>
       </td>
       <td>
    
        {{number_format($ducKienAccount->amount ,0)  }}VND
       </td>
     </tr> 










</table>



</div>
<div class="col-sm-4">
  <a class="btn btn-default pull-right" href="{!! url('/adminsites/history/withdrawal') !!}" role="button">Rút tiền</a>
</div>
<div class="clearfix"></div>
</div>


@endsection
@section('footer')

@endsection
