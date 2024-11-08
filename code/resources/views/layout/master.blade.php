<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
        <link rel="stylesheet" href="{{ asset('./assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('./assets/css/colors/persian-iIndigo.css') }}">
        <link rel="stylesheet" href="{{ asset('./assets/css/custom.css') }}">
        <link rel="preload"  as="style" onload="this.rel='stylesheet'" href="{{ asset('./assets/css/fonts/dm.css') }}">

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    
        @yield('meta_seo')
        <title>@yield('meta_title')</title>

        
        @yield('web_styles')
       
    </head>
    <body class="ticky-header @yield('body_class')" >
   

         @yield('web_header')
        
        @yield('web_sidebar') 

        @yield('web_breadcrumb')
        @yield('web_content')



    @yield('web_footer')
    
    

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
    </div>

    <script src="{{ asset('assets/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    @yield('web_footer_scripts')

    <div class="modal fade" id="script_error" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Error</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <p>@yield('error_response','Sorry, something went wrong. Please try again, or refresh the page. If you keep seeing this message, pease contact your system administrator.')</p>
      </div>
      <div class="modal-footer py-1">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

   

 

    
    <script type="text/javascript">
        function errors(jqXHR,empty_container=true,modal_error=false) 
        {
          $('.default_error').hide();
          errormsg = '';
          if (jqXHR.responseJSON.error) {
            errormsg = jqXHR.responseJSON.error + '<br>' +' ' ;
          }
          if (jqXHR.responseJSON.message) {
            errormsg = errormsg +  jqXHR.responseJSON.message;
          }
          if (modal_error) {

            $('#script_error').modal('show')
          }else
          {

            toastr.error(errormsg, 'Error');
          }
            $('.custom_error').html(errormsg).show();
                    
          if (empty_container) {

            $('.content_container').html();
          }
        }
    </script>
</body>

</html>