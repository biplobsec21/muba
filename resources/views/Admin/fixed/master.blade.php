<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <!-- Bootstrap -->
        <link href="{{ asset('/public/assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('/public/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('/public/assets/nprogress/nprogress.css')}}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{ asset('/public/assets/iCheck/skins/flat/green.css')}}" rel="stylesheet">

        <!-- bootstrap-progressbar -->
        <link href="{{ asset('/public/assets/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
        <!-- JQVMap -->
        <link href="{{ asset('/public/assets/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset('/public/assets/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

        <link href="{{ asset('/public/css/bootstrap-datetimepicker.css')}}" rel="stylesheet">
        <link href="{{ asset('/public/css/bootstrap-timepicker.min.css')}}" rel="stylesheet">
        <!-- Data table -->

        <link href="{{ asset('/public/assets/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('/public/assets/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('/public/assets/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('/public/assets/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{ asset('/public/assets/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{ asset('/public/assets/custom/css/custom.css')}}" rel="stylesheet">
        <!-- this file will be ours admin_style-->
        <link href="{{ asset('/public/assets/select2/dist/css/select2.min.css')}}" rel="stylesheet">

        <link href="{{ asset('/public/assets/custom/css/admin_style.css')}}" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    @yield('left_bar')
                </div>   

                <div class="top_nav">
                    @yield('top_bar')
                </div>
               
                <!-- page content -->
                <div class="right_col" role="main">
                    @yield('content')
                </div>
                <!-- end page content -->

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset('/public/assets/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('/public/assets/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{ asset('/public/assets/fastclick/lib/fastclick.js')}}"></script>
        <!-- NProgress -->
        <script src="{{ asset('/public/assets/nprogress/nprogress.js')}}"></script>
        <!-- Chart.js -->
        <script src="{{ asset('/public/assets/Chart.js/dist/Chart.min.js')}}"></script>
        <!-- gauge.js -->
        <script src="{{ asset('/public/assets/gauge.js/dist/gauge.min.js')}}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{ asset('/public/assets/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
        <!-- iCheck -->
        <script src="{{ asset('/public/assets/iCheck/icheck.min.js')}}"></script>
        <!-- Skycons -->
        <script src="{{ asset('/public/assets/skycons/skycons.js')}}"></script>
        <!-- Flot -->
        <script src="{{ asset('/public/assets/Flot/jquery.flot.js')}}"></script>
        <script src="{{ asset('/public/assets/Flot/jquery.flot.pie.js')}}"></script>
        <script src="{{ asset('/public/assets/Flot/jquery.flot.time.js')}}"></script>
        <script src="{{ asset('/public/assets/Flot/jquery.flot.stack.js')}}"></script>
        <script src="{{ asset('/public/assets/Flot/jquery.flot.resize.js')}}"></script>
        <!-- Flot plugins -->
        <script src="{{ asset('/public/assets/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
        <script src="{{ asset('/public/assets/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
        <script src="{{ asset('/public/assets/flot.curvedlines/curvedLines.js')}}"></script>
        <!-- DateJS -->
        <script src="{{ asset('/public/assets/DateJS/build/date.js')}}"></script>
        <!-- JQVMap -->
        <script src="{{ asset('/public/assets/jqvmap/dist/jquery.vmap.js')}}"></script>
        <script src="{{ asset('/public/assets/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
        <script src="{{ asset('/public/assets/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{ asset('/public/assets/moment/min/moment.min.js')}}"></script>
        <script src="{{ asset('/public/assets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{ asset('/public/assets/custom/js/custom.js')}}"></script>

        <!-- Datatables -->
        <script src="{{ asset('/public/assets/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
        <script src="{{ asset('/public/assets/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>

        <script src="{{ asset('/public/js/bootstrap-datetimepicker.js')}}"></script>
        <script src="{{ asset('/public/js/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{ asset('/public/assets/select2/dist/js/select2.min.js')}}"></script>
        <script src="{{ asset('/public/js/script.js')}}"></script>
        @yield('foot_css_js')

    </body>
</html>