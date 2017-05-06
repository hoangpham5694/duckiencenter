<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<link rel="stylesheet" href="">
	<link href="<?php echo asset('public/template/vendor/bootstrap/css/bootstrap.min.css') ; ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo asset('public/template/vendor/metisMenu/metisMenu.min.css') ; ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo asset('public/template/dist/css/sb-admin-2.css') ; ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo asset('public/template/vendor/font-awesome/css/font-awesome.min.css') ; ?>" rel="stylesheet" type="text/css">
   <link href="<?php echo asset('public/template/css/guest.css') ; ?>" rel="stylesheet" type="text/css">
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
				<img src="{{ asset('public/images/banner.jpg') }}" alt="">
			</div>
			<div class="slide-show">
				  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

      <div class="item active">
        <img src="{{ asset('public/images/slide1.jpg') }}" alt="Chania" >

      </div>

      <div class="item">
        <img src="{{ asset('public/images/slide2.jpg') }}" alt="Chania" >

      </div>
    


      <div class="item">
        <img src="{{ asset('public/images/slide3.jpg') }}" alt="Flower" >
       
      </div>
  
    </div>

    <!-- Left and right controls -->
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
			
		<div class="menu">




						<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">WebSiteName</a>
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
					</div>
					<div class="navbar-collapse">
						<ul class="nav navbar-nav">
						<li class="active"><a href="#">Home</a></li>
                  <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#">Page 1-1</a></li>
          <li><a href="#">Page 1-2</a></li>
          <li><a href="#">Page 1-3</a></li>
        </ul>
      </li>
						<li><a href="#">Page 1</a></li>
						<li><a href="#">Page 2</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
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
			<div class="col-sm-3 ads">
				dfg
			</div>
			<div class="clearfix"></div>
		</div>

	</div>
	<div id="footer">
		<div style="width:100%; height:100px;"></div>
    <div class="container">
      <nav class="navbar navbar-inverse">

  <p class="navbar-text">Copyright © 2017 Bản quyền thuộc về Công ty TNHH Hỗ trợ giáo dục - Thương mại Đức Kiến.<br>
  Thiết kế và phát triển bởi Phạm Minh Hoàng - ĐHSP Đà Nẵng
  </p>
</nav>
    </div>
  
	</div>
	    <script src="<?php echo asset('public/template/vendor/jquery/jquery.min.js') ; ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo asset('public/template/vendor/bootstrap/js/bootstrap.min.js') ; ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo asset('public/template/vendor/metisMenu/metisMenu.min.js') ; ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo asset('public/template/js/guest.js') ; ?>"></script>
    <script src="<?php echo asset('public/app/lib/angular.min.js') ; ?>"></script>
    <script src="<?php echo asset('public/app/app.js') ; ?>"></script>   
@yield('footer')
</body>
</html>