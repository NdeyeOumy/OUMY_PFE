<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>@yield('title', "SGCU")</title>

    <!-- permet de securiser -->
    <meta name="csrf-token" content="{{ csrf_token()}}">
    <!-- Bootstrap -->
    <link href="{{ asset('bo/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('bo/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('bo/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('bo/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('bo/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('bo/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('bo/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('bo/build/css/custom.min.css') }}" rel="stylesheet">

    {{-- custom style--}}
    @yield('cssblock')

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layouts.sidebar')

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        @include('layouts.header')
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
       @include('layouts.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('bo/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('bo/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bo/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('bo/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('bo/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('bo/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('bo/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('bo/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('bo/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('bo/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('bo/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('bo/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('bo/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('bo/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('bo/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('bo/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('bo/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('bo/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('bo/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('bo/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('bo/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('bo/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('bo/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('bo/build/js/custom.min.js') }}"></script>

	 {{-- custom js--}}
     @yield('jsblock')
  </body>
</html>
