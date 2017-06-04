@extends('admin.master')
@section('header')
<title>Admin::Chi tiết rút tiền</title>
@endsection
@section('title','Chi tiết rút tiền')
@section('content')

<div class="row teacher-info">

  <div class="col-sm-8 info">
    <table>
      <tr>
        <td>
         <strong>Nội dung:</strong>
       </td>
       <td>
    
        {{ $history->name }}
       </td>
     </tr> 
      <tr>
        <td>
         <strong>Số tiền rút:</strong>
       </td>
       <td>
    
     
           {{number_format( $history->money,0)  }} VND
       </td>
     </tr> 

      <tr>
        <td>
         <strong>Số tiền còn lại:</strong>
       </td>
       <td>
    
     
           {{number_format( $history->amount,0)  }} VND
       </td>
     </tr> 
           <tr>
        <td>
         <strong>Ngày rút:</strong>
       </td>
       <td>
    
     
         {{ Carbon\Carbon::parse($history->created_at)->format('h:i') }} Ngày {{ Carbon\Carbon::parse($history->created_at)->format('d/m/y') }}
       </td>
     </tr> 







</table>



</div>
<div class="col-sm-4">
  <a class="btn btn-default pull-right" href="{!! url('/adminsites/history/withdrawalbill') !!}/{{ $history->id }}" role="button">In hóa đơn</a>
</div>
<div class="clearfix"></div>
</div>


@endsection
@section('footer')

@endsection
