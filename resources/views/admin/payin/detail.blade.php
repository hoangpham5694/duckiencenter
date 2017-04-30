@extends('admin.master')
@section('header')
<title>Admin::Chi tiết Hóa đơn</title>
@endsection
@section('title')
Chi tiết Hóa đơn thu tiền
@endsection
@section('content')
  <div class="row teacher-info" >

    <div class="col-sm-8 info">
      <table>
        <tr>
          <td>
           <strong>Mã hóa đơn:</strong>
         </td>
         <td>
           {{ $payin->id }}
         </td>
       </tr> 
       <tr>
        <td>
         <strong>Mã học viên:</strong>
       </td>
       <td>
        {{ $payin->username }}
      </td>
    </tr> 
           <tr>
        <td>
         <strong>Tên học viên:</strong>
       </td>
       <td>
       {{ $payin->lastname }} {{ $payin->firstname }}
      </td>
    </tr> 
    <tr>
      <td>
       <strong>Số tiền nộp:</strong>
     </td>
     <td>
       {{number_format( $payin->real_money,0)  }} VND
    </td>
  </tr> 
  <tr>
    <td>
     <strong>Số tiền cộng vào tài khoản:</strong>
   </td>
   <td>

    {{number_format($payin->virtual_money,0)  }} VND
  </td>
</tr>
  <tr>
    <td>
     <strong>Số dư sau khi nộp:</strong>
   </td>
   <td>

    {{number_format($payin->amount,0)  }} VND
  </td>
</tr>
<tr>
  <td>
   <strong>Ngày nộp tiền:</strong>
 </td>
 <td>  
   {{ Carbon\Carbon::parse($payin->created_at)->format('h:i') }} Ngày {{ Carbon\Carbon::parse($payin->created_at)->format('d/m/y') }}
 </td>
</tr>

<tr>
  <td>
   <strong>Nhân viên thu tiền:</strong>
 </td>
 <td> 
   {{ $payin->name }}
  </td>
</tr>
<tr>
  <td>
    <strong>Trạng thái:</strong>
  </td>
  <td>  
    @if($payin->is_paid == 1)
        Đã thanh toán
    @else
      Chưa thanh toán
    @endif


 </td>
</tr>


</table>



</div>
<div class="col-sm-4">
  <a class="btn pull-right"  target="_blank" href="{!! url('adminsites/payin/bill')!!}/{!! $payin->id !!}" ><i class="fa fa-print" aria-hidden="true"></i> In hóa đơn</a>
 
</div>
<div class="clearfix"></div>
</div>








@endsection
@section('footer')

<script>

</script>
<script src="<?php echo asset('public/app/controller/admins/DetailAttendanceController.js') ; ?>"></script>  

@endsection
