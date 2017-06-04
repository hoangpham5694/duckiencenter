@extends('guest.master')
@section('header')
    <title>{{ $cate->name }}</title>
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
@endsection

@section('content')
<div ng-controller="ListPostController">
	<div class="cate-name">
	<h2>{{ $cate->name }}</h2>
</div>

<div class="list-post" data-ng-init="getListPosts({{ $cate->id }})">
	<div class="item" ng-repeat="news in newss">
      	<div class="col-sm-2">
      		<a href="">
      			<img ng-src="{!! asset('upload/newsimages') !!}/{% news.image%} " alt="">
      		</a>
      	</div>
      	<div class="col-sm-10">
      		<a href=""><h4>{% news.title%} </h4></a>
      		
      		<p> 
				{% news.description%}
      		 </p>
      	</div>
      	<div class="clearfix"></div>
      	<div class="date-post pull-right">{% news.created_at | dateFilter | date:"dd-MM-yyyy"%}</div>
      	<div class="clearfix"></div>
      </div>
</div>
<div class="btn-toolbar" role="toolbar" aria-label="...">
  <div class="btn-group" role="group" aria-label="...">
  	<button type="button" ng-repeat="n in [1,total] | makeRange" ng-click="changePage(n)" class="btn btn-default" ng-disabled="page == n">{% n %}</button>
  </div>

</div>
</div>

@endsection

@section('footer')
  <script src="<?php echo asset('app/controller/guests/ListPostController.js') ; ?>"></script>  
@endsection
