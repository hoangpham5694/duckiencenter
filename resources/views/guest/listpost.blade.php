@extends('guest.master')
@section('header')
    <title>{{ $cate->name }}</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div class="cate-name">
	<h2>{{ $cate->name }}</h2>
</div>
sfs
<div class="list-post">
	
</div>
@endsection

@section('footer')

@endsection
