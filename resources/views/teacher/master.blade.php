<!DOCTYPE html>
<html lang="en" ng-app="my-app"     >

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">



    <link href="<?php echo asset('template/vendor/bootstrap/css/bootstrap.min.css') ; ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo asset('template/vendor/metisMenu/metisMenu.min.css') ; ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo asset('template/dist/css/sb-admin-2.css') ; ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo asset('template/vendor/font-awesome/css/font-awesome.min.css') ; ?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
        <link href="<?php echo asset('template/css/teacher.css') ; ?>" rel="stylesheet" type="text/css">
    @yield('header')
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Teacher Area</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
     
             
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         {!! Auth::guard('teachers')->user()->lastname!!} {!! Auth::guard('teachers')->user()->firstname!!} 
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                                        <ul class="dropdown-menu dropdown-user">
                        <li><a href="{!! url('teachersites/account/profile') !!}"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân</a>
                        </li>
                        <li><a href="{!! url('teachersites/account/edit') !!}"><i class="fa fa-gear fa-fw"></i> Cập nhật thông tin</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{!! url('logout') !!}"><i class="fa fa-sign-out fa-fw"></i> Đăng xuất</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                     
                      
                                                                <li>
                            <a href="{!! url('teachersites/course/') !!}"><i class="fa fa-briefcase" aria-hidden="true"></i> Các lớp đang dạy</a>
                            
                            <!-- /.nav-second-level -->
                        </li>
                                
                       
                      
                       
       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> @yield('title')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                @yield('content')

            </div>
            <!-- /.row -->

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?php echo asset('template/vendor/jquery/jquery.min.js') ; ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo asset('template/vendor/bootstrap/js/bootstrap.min.js') ; ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo asset('template/vendor/metisMenu/metisMenu.min.js') ; ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo asset('template/dist/js/sb-admin-2.js') ; ?>"></script>

    <script src="<?php echo asset('app/lib/angular.min.js') ; ?>"></script>
    <script src="<?php echo asset('app/app.js') ; ?>"></script>   

@yield('footer')
</body>

</html>
