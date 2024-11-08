@extends('layouts.master')

@section('admin_header')
    @include('layouts.admin_header')
@endsection('admin_header')

@section('admin_sidebar')
    @include('layouts.admin_sidebar')
@endsection('admin_sidebar')



@section('admin_breadcrumb')
<!--page title and breadcrumb start -->
<div class="page-head-wrap">
    <h4 class="margin0">
            @yield('admin_breadcrumb_heading')
        
    </h4>
    <div class="breadcrumb-right">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li> 
            @yield('admin_breadcrumb_links')
        </ol>
    </div>
</div>
@endsection('admin_breadcrumb')





@section('admin_footer_scripts')

<div class="modal" id="isnotallowed" data-keyboard="false" data-backdrop="static"  class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">This action is unauthorized</h4>
      </div>
      <div class="modal-body">
        <p>You are not allowed to perform this action. Please contact to the administrator.</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div class="modal" id="script_error" data-keyboard="false" data-backdrop="static"  class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title modaltitle">Error</h4>
      </div>
      <div class="modal-body">
        <p class="default_error">@yield('error_response','Sorry, something went wrong. Please try again, or refresh the page. If you keep seeing this message, pease contact your system administrator.')</p>
        <p class="custom_error" style="display: none;"></p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<link href="{{ URL::asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">


<script src="{{ URL::asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/datatables-tabletools/js/dataTables.tableTools.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/datatables-colvis/js/dataTables.colVis.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/datatables-responsive/js/dataTables.responsive.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/datatables-scroller/js/dataTables.scroller.js') }}"></script>
        <script src="https://cdn.datatables.net/fixedcolumns/3.3.1/js/dataTables.fixedColumns.min.js"></script>
        <script src="{{ URL::asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ URL::asset('admin/bower_components/toastr/toastr.min.js') }}"></script>



<script type="text/javascript">
    $('.responsive-data-table').DataTable({
            "PaginationType": "bootstrap",
            responsive: true,
            "columnDefs": [
                { "orderable": false, "targets": [0,-1] }
              ],
               
            
        });

</script>

@yield('more_scripts')

@include('layouts.errors')

@endsection('admin_footer_scripts')

@section('admin_styles')

<!-- Material Design Bootstrap -->


<link href="{{ URL::asset('admin/bower_components/datatables/media/css/jquery.dataTables.css') }}" rel="stylesheet">
<link href="{{ URL::asset('admin/bower_components/datatables-responsive/css/responsive.dataTables.scss') }}" rel="stylesheet">
<link href="https://cdn.datatables.net/fixedcolumns/3.3.1/css/fixedColumns.dataTables.min.css" rel="stylesheet">
<link href="{{ URL::asset('admin/dist/css/animate372.min.css') }}" rel="stylesheet">
@endsection('admin_styles')