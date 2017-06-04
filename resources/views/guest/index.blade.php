@extends('guest.master')
@section('header')
    <title>Lớp học vật lý</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div class="new-post">
	<div class="col-sm-6 ">
		<div class="new-post-left">
			<img src="{{ asset('upload/newsimages') }}/{!! $lastNews->image !!}" alt="">
			<a href="" class="title">
				<h3>
					{!! $lastNews->title !!}

				</h3>
			</a>
			<p>
				{!! $lastNews->description !!}
			</p>
		</div>

	</div>
	<div class="col-sm-6 ">
		<div class="new-post-right">
			@foreach($listLastNews as $itemListLastNews)
			<div class="item">
				<a href="{{ url('bai-viet') }}/{!! $itemListLastNews->id !!}/{!! $itemListLastNews->slug !!}.html" class="title">
					<h4>
						<i class="bullet bullet-12"></i>{!! $itemListLastNews->title!!}
					</h4>
				</a>
			</div>
			@endforeach
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<div class="group-post">
	<div class="tab">
		<ul class="nav nav-pills nav-justified">

			<li class="active"><a data-toggle="pill"  href="#menu1">Lớp mới</a></li>
			<li><a data-toggle="pill" href="#menu2">Hoạt động</a></li>
			<li><a data-toggle="pill" href="#menu3">Tin tức</a></li>
		</ul>
	</div>
	<div class="list-post">
		  <div class="tab-content">
	<?php $maxDigit = 250 ?>
    <div id="menu1" class="tab-pane fade in active">
      <h3>Các lớp sắp khai giảng</h3>
      @foreach($listPostNewCourses as $postItem)
      <div class="item">
      	<div class="col-sm-2">
      		<a href="{{ url('bai-viet') }}/{!! $postItem->id !!}/{!! $postItem->slug !!}.html">
      			<img src="{!! asset('upload/newsimages') !!}/{!! $postItem->image!!}" alt="">
      		</a>
      	</div>
      	<div class="col-sm-10">
      		<a href="{{ url('bai-viet') }}/{!! $postItem->id !!}/{!! $postItem->slug !!}.html"><h4> {!! $postItem->title!!} </h4></a>
      		
      		<p> 
				{{ str_limit($postItem->description, $limit = $maxDigit, $end = '...') }}
      		 </p>
      	</div>
      	<div class="clearfix"></div>
      </div>
      @endforeach
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Hoạt động</h3>
      @foreach($listPostActivities as $postItem)
      <div class="item">
      	<div class="col-sm-2">
      		<a href="{{ url('bai-viet') }}/{!! $postItem->id !!}/{!! $postItem->slug !!}.html">
      			<img src="{!! asset('upload/newsimages') !!}/{!! $postItem->image!!}" alt="">
      		</a>
      	</div>
      	<div class="col-sm-10">
      		<a href="{{ url('bai-viet') }}/{!! $postItem->id !!}/{!! $postItem->slug !!}.html"><h4> {!! $postItem->title!!} </h4></a>
      		
      		<p> 
				{{ str_limit($postItem->description, $limit = $maxDigit, $end = '...') }}
      		 </p>
      	</div>
      	<div class="clearfix"></div>
      </div>
      @endforeach
    </div>
    <div id="menu3" class="tab-pane fade">
  <h3>Hoạt động</h3>
      @foreach($listPostNews as $postItem)
      <div class="item">
      	<div class="col-sm-2">
      		<a href="{{ url('bai-viet') }}/{!! $postItem->id !!}/{!! $postItem->slug !!}.html">
      			<img src="{!! asset('upload/newsimages') !!}/{!! $postItem->image!!}" alt="">
      		</a>
      	</div>
      	<div class="col-sm-10">
      		<a href="{{ url('bai-viet') }}/{!! $postItem->id !!}/{!! $postItem->slug !!}.html"><h4> {!! $postItem->title!!} </h4></a>
      		
      		<p> 
				{{ str_limit($postItem->description, $limit = $maxDigit, $end = '...') }}
      		 </p>
      	</div>
      	<div class="clearfix"></div>
      </div>
      @endforeach
    </div>
  </div>
	</div>
</div>
@endsection

@section('footer')

@endsection
