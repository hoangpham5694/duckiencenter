@extends('masters.bill')
@section('title')
   HÓA ĐƠN RÚT TIỀN
@endsection

@section('content')
<ul>

	<li style="list-style-type:none">
		Nội dung:&nbsp;&nbsp;
		<strong>
			{{ $history->name }}
		</strong>
	</li>

	<li style="list-style-type:none">
		Số tiền rút:&nbsp;&nbsp;
		<strong>
			{{number_format( $history->money,0)  }} VND
		</strong>
	</li>                            
	<li style="list-style-type:none">
		Số tiền còn lại:&nbsp;
		<strong>
			{{number_format($history->amount,0)  }} VND
		</strong>
	</li>


	<li style="list-style-type:none">
		Ngày rút tiền:&nbsp;&nbsp;
		<strong>
			{{ Carbon\Carbon::parse($history->created_at)->format('d/m/y - h:i') }}
		</strong>
	</li>


</ul>

@endsection
@section('foot-left','Người rút tiền')
@section('foot-right','')