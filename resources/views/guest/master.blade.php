<!DOCTYPE html>
<html lang="en" ng-app="my-app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<link rel="stylesheet" href="">
	<link href="<?php echo asset('template/vendor/bootstrap/css/bootstrap.min.css') ; ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo asset('template/vendor/metisMenu/metisMenu.min.css') ; ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo asset('template/dist/css/sb-admin-2.css') ; ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo asset('template/vendor/font-awesome/css/font-awesome.min.css') ; ?>" rel="stylesheet" type="text/css">
   <link href="<?php echo asset('template/css/guest.css') ; ?>" rel="stylesheet" type="text/css">
    <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 100%;
      margin: auto;
  }
  </style>
    @yield('header')
</head>
<body>
	<div id="head">
		<div class="container">
			<div class="banner">
				<img src="{{ asset('images/banner2.jpg') }}" alt="">
			</div>
      <!--
			<div class="slide-show">
				  <div id="myCarousel" class="carousel slide" data-ride="carousel">

    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    
    </ol>

   
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="{{ asset('images/slide1.jpg') }}" alt="Chania" >

      </div>

      <div class="item">
        <img src="{{ asset('images/slide2.jpg') }}" alt="Chania" >

      </div>
    


      <div class="item">
        <img src="{{ asset('images/slide3.jpg') }}" alt="Flower" >
       
      </div>
  
    </div>

   
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
			</div>
			-->
		<div class="menu">




						<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="{{ url('/') }}">Trang Chủ</a>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
					</div>
					<div class="navbar-collapse">
						<ul class="nav navbar-nav">
						<li ><a href="{{ url('bai-viet/9/gioi-thieu-trung-tam.html') }}">Giới thiệu</a></li>
                  <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Các lớp học
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="{{ url('lop-hoc') }}">Các lớp đang học</a></li>
          <li><a href="{{ url('danh-muc/2/cac-lop-sap-khai-giang.html') }}">Các lớp sắp khai giảng</a></li>
         
        </ul>
      </li>
						<li><a href="{{ url('giao-vien') }}">Giáo viên</a></li>
						<li><a href="{{ url('hoc-vien') }}">Học viên</a></li>
            <li><a href="{{ url('danh-muc/3/hoat-dong.html') }}">Hoạt động</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
	
						<li><a href="{{ url('login') }}">Đăng nhập</a></li>
					</ul>
					</div>

				</div>
			</nav>
		</div>

	</div>


	</div>
	<div id="main">
		<div class="container ">
			<div class="col-sm-9 main-content">
				@yield('content')
			</div>
			<div class="col-sm-3 ads" ng-controller="AdsController" data-ng-init="getListAds()">
				<div class="ads-item" ng-repeat="ads in adss">
            <a ng-href="{%ads.url%}" target="_blank">
              <img ng-src="{{ asset('upload/adsimages') }}/{%ads.image%}" alt="">
            </a>
        </div>
			</div>
			<div class="clearfix"></div>
		</div>

	</div>
	<div id="footer">
		<div style="width:100%; height:100px;"></div>
    <div class="container">
      <nav class="navbar navbar-inverse">

  <p class="navbar-text">Copyright © 2017 Bản quyền thuộc về lophocvatly.com.<br>
  Thiết kế và phát triển bởi Phạm Minh Hoàng - ĐHSP Đà Nẵng
  </p>
</nav>
    </div>
  
	</div>
	    <script src="<?php echo asset('template/vendor/jquery/jquery.min.js') ; ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo asset('template/vendor/bootstrap/js/bootstrap.min.js') ; ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo asset('template/vendor/metisMenu/metisMenu.min.js') ; ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo asset('template/js/guest.js') ; ?>"></script>
    <script src="<?php echo asset('app/lib/angular.min.js') ; ?>"></script>
    <script src="<?php echo asset('app/app.js') ; ?>"></script>   
    <script src="<?php echo asset('app/controller/guests/AdsController.js') ; ?>"></script>  
@yield('footer')
</body>
</html>