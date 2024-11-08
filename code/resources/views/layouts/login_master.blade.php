<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Login</title>

        <!-- inject:css -->
    <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/weather-icons/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/themify-icons/css/themify-icons.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/toastr/toastr.css') }}">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/main.css') }}">

        <script src="{{ URL::asset('admin/assets/js/modernizr-custom.js') }}"></script>
    </head>
    <body>

        @yield('main')

        <!-- inject:js -->
        <script src="{{ URL::asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/autosize/dist/autosize.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/toastr/toastr.min.js') }}"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="{{ URL::asset('admin/dist/js/main.js') }}"></script>

        @include('layouts.errors')

        <script type="text/javascript">
             toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
        </script>
        
         @yield('web_footer_scripts')


         

    </body>
</html>
