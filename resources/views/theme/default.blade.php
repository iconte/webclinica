<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">



    <title>Web Clinica</title>



    <!-- Bootstrap Core CSS -->

    <link href="{!! asset('theme/vendor/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    {{--<link href="{!! asset('theme/vendor/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
   <!-- MetisMenu CSS -->
    <link href="{!! asset('theme/vendor/metisMenu/metisMenu.min.css') !!}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{!! asset('theme/dist/css/sb-admin-2.min.css') !!}" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="{!! asset('theme/vendor/morrisjs/morris.css') !!}" rel="stylesheet">
    <!-- Custom Fonts -->

    <script src="{!! asset('theme/vendor/jquery/jquery.min.js') !!}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{!! asset('theme/vendor/bootstrap/js/bootstrap.min.js') !!}"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{!! asset('theme/vendor/metisMenu/metisMenu.min.js') !!}"></script>
    <!-- Morris Charts JavaScript -->
    <script src="{!! asset('theme/vendor/raphael/raphael.min.js') !!}"></script>
    <script src="{!! asset('theme/vendor/morrisjs/morris.min.js') !!}"></script>
    <!-- Custom Theme JavaScript -->
    <script src="{!! asset('theme/dist/js/sb-admin-2.js') !!}"></script>
</head>

<body>



<div id="wrapper">



    <!-- Navigation -->

    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">

        @include('theme.header')

        @include('theme.sidebar')

    </nav>



    <div id="page-wrapper">

        @yield('content')

    </div>

    <!-- /#page-wrapper -->



</div>

<!-- /#wrapper -->



<!-- jQuery -->





</body>



</html>