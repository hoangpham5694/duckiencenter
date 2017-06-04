<!DOCTYPE html>
<html lang="en" ng-app="my-app">

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
        <link href="<?php echo asset('template/css/admin.css') ; ?>" rel="stylesheet" type="text/css">
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
                <a class="navbar-brand" href="index.html">Admin Area</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        {!! Auth::guard('users')->user()->name!!} 
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{!! url('adminsites/account/profile') !!}"><i class="fa fa-user fa-fw"></i> Thông tin cá nhân</a>
                        </li>
                        <li><a href="{!! url('adminsites/account/edit') !!}"><i class="fa fa-gear fa-fw"></i> Cập nhật thông tin</a>
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
                            <a href="{!! url('adminsites') !!}"><i class="fa fa-dashboard fa-fw"></i> Trang chủ</a>
                        </li>
                         <li>
                            <a href="{!! url('adminsites/check-attendance/index') !!}"><i class="fa fa-check-square-o" ></i> Kiểm tra buổi học</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Thống kê<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="#">Morris.js Charts</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                        <li>
                            <a href="#">
                                <i class="fa fa-female" aria-hidden="true"></i>
                                Quản lý giáo viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/teacher/add') !!}">Thêm giáo viên</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/teacher/list') !!}">Danh sách giáo viên</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>




                         <li>
                            <a href="#"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Quản lý học viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/student/add') !!}">Thêm học viên</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/student/list') !!}">Danh sách học viên</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-briefcase" aria-hidden="true"></i> Quản lý lớp học<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/course/add') !!}">Thêm lớp học</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/course/list') !!}">Danh sách lớp học</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#">
                              <i class="fa fa-money" aria-hidden="true"></i>
                                Học phí<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/payin/index') !!}">Thu học phí</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/payin/history') !!}">Lịch sử</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>           
                             <li>
                            <a href="#">
                              <i class="fa fa-credit-card" aria-hidden="true"></i>
                                Lương giáo viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/payout/index') !!}">Thanh toán lương</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/payout/history') !!}">Lịch sử</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>


                        <li>
                            <a href="#">
                             <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                Quản lí nhân viên<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/user/add') !!}">Thêm nhân viên</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/user/list') !!}">Danh sách</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                                                <li>
                            <a href="#">
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                                Quản lí Bài viết<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/news/add') !!}">Thêm bài viết</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/news/list') !!}">Danh sách</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
              <li>
                            <a href="#">
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                                Quản lí Banner<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/ads/add') !!}">Thêm quảng cáo</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/ads/list') !!}">Danh sách</a>
                                </li>
                      
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                           <li>
                            <a href="#">
                            <i class="fa fa-sticky-note-o" aria-hidden="true"></i>
                                Quản lí Tiền trung tâm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! url('adminsites/history/withdrawal') !!}">Rút tiền</a>
                                </li>
                                <li>
                                    <a href="{!! url('adminsites/history/index') !!}">Kiểm tra tiền</a>
                                </li>
                      
                            </ul>
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
                 @include('blocks.error')  
                @include('blocks.flash')
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
