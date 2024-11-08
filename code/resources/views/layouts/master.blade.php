<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Mydrop</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/toastr/toastr.css') }}">
     
        @yield('admin_styles')
        <!-- Main Style  -->
        <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/main.css') }}">
        {{-- <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/style.css') }}"> --}}
        <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/custom.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/select2/dist/css/select2.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/select2/dist/css/select22.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
        
         <!-- inject:js -->
        <script src="{{ URL::asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        

       
    </head>
    <body>
        <div id="ui" class="ui @yield('aside-compact')">
        <!--header start-->
        @yield('admin_header')
        <!--header end-->

        <!--sidebar start--> 
        @yield('admin_sidebar') 
         @yield('student_sidebar') 
          @yield('parent_sidebar')      
        <!--sidebar end-->

        <!--main content start-->
        <div id="content" class="ui-content ui-content-aside-overlay">
                
                @yield('admin_breadcrumb')
                @yield('student_breadcrumb')
                @yield('parent_breadcrumb')

                <div class="ui-content-body">

                    <div class="ui-container">
                   
                    
                        @yield('admin_content')
                        
                     
                    </div>
                </div>
        </div>

        <!--main content end-->

        <!--footer start-->
            <div id="footer" class="ui-footer">
                {{date('Y')}} &copy; Mydrop
            </div>
            <!--footer end-->

        </div>

       
       
        @yield('admin_footer_scripts')
         
        <script src="{{ URL::asset('admin/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/autosize/dist/autosize.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/moment/moment.js') }}"></script>
        
        <script src="{{ URL::asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>


        <!-- Common Script   -->
        <script src="{{ URL::asset('admin/dist/js/main.js') }}"></script>
        <script src="{{ URL::asset('admin/assets/js/modernizr-custom.js') }}"></script>


    </body>
</html>
 
