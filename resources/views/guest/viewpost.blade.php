@extends('guest.master')
@section('header')
    <title>{{ $post->title }}</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div class="post-title">
	<h2>{{ $post->title }}</h2>
	<div class="date-post pull-right">
		
		   {{ Carbon\Carbon::parse($post->created_at)->format('d-m-Y') }}
	</div>
	<div class="clearfix"></div>
</div>
<div class="post-main">
	<div class="description">
		<div class="col-sm-3">
				<img src="{!! asset('upload/newsimages') !!}/{!! $post->image!!}" alt="">
		</div>
		<div class="col-sm-9">
			<b>{{ $post->description }}</b>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="content">
		{!! $post->content !!}
	</div>
</div>
@endsection

@section('footer')

@endsection
