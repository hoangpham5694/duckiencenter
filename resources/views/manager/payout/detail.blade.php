@extends('manager.master')
@section('header')
<title>Manager::Chi tiết thanh toán</title>
@endsection
@section('title')
Chi tiết Hóa đơn thanh toán
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
           {{ $payout->id }}
         </td>
       </tr> 
       <tr>
        <td>
         <strong>Mã giáo viên:</strong>
       </td>
       <td>
        {{ $payout->username }}
      </td>
    </tr> 
           <tr>
        <td>
         <strong>Tên giáo viên:</strong>
       </td>
       <td>
       {{ $payout->lastname }} {{ $payout->firstname }}
      </td>
    </tr> 
    <tr>
      <td>
       <strong>Số tiền rút:</strong>
     </td>
     <td>
       {{number_format( $payout->paid_money,0)  }} VND
    </td>
  </tr> 

  <tr>
    <td>
     <strong>Số dư sau khi rút:</strong>
   </td>
   <td>

    {{number_format($payout->amount,0)  }} VND
  </td>
</tr>
<tr>
  <td>
   <strong>Ngày rút tiền:</strong>
 </td>
 <td>  
   {{ Carbon\Carbon::parse($payout->created_at)->format('h:i') }} Ngày {{ Carbon\Carbon::parse($payout->created_at)->format('d/m/y') }}
 </td>
</tr>

<tr>
  <td>
   <strong>Nhân viên thanh toán:</strong>
 </td>
 <td> 
   {{ $payout->name }}
  </td>
</tr>
<tr>
  <td>
    <strong>Trạng thái:</strong>
  </td>
  <td>  
    @if($payout->is_paid == 1)
        Đã thanh toán
    @else
      Chưa thanh toán
    @endif


 </td>
</tr>


</table>



</div>
<div class="col-sm-4">
  <a class="btn pull-right"  target="_blank" href="{!! url('managersites/payout/bill')!!}/{!! $payout->id !!}" ><i class="fa fa-print" aria-hidden="true"></i> In hóa đơn</a>
 
</div>
<div class="clearfix"></div>
</div>








@endsection
@section('footer')


@endsection
