@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       @yield('main_title')
            
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links')
            @yield('more_breadcrumb')
            <li><a href="#" class="active">@yield('main_title')</a></li>
    @endsection('admin_breadcrumb_links')
 
 

@section('admin_content')


@yield('alert_section')
<div class="row">
        

    <form class="form-horizontal"   method="post" action="@yield('deleteall_route')">
        {{csrf_field()}}
    <div class="col-md-12">
        
        

        <div class="panel">

            <header class="panel-heading panel-border">

                
                
                    
                @yield('can_create')
                @yield('can_delete')
                @yield('can_edit')
                
                @yield('other_button')    

                 
                
                
            </header>
            
            <div class="panel-body table-responsive">
                <div class="">

                    <table class="table table-striped table-bordered table-hover datatable  custom-datatable @yield('datatable_class','responsive-data-table')">
                        <thead>
                            <tr>
                                @section('small_action_checkbox')
                                <th class="action_col small_action">
                                    <label class="i-checks">
                                        <input  type="checkbox" value="1" class="selectall" name="allchecked"><i></i>
                                    </label>
                                </th>
                                @show

                                @yield('table_head','')
                                @section('table_action')
                                <th class="action_col small_action">Action</th>
                                @show
                                
                                
                                
                            </tr>
                        </thead>
                        
                        <tbody class="customtd">

                            @yield('table_body')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal" id="@yield('deletemodalid','deletemodalid')" data-keyboard="false" data-backdrop="static"  class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Action Required</h4>
      </div>
      <div class="modal-body">
        <p>@yield('deletemsg',"Do you want to delete this and all its related record.")</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" >Yes</button>
      </div>
    </div>

  </div>
</div>

    </form>

</div>   

@yield('add_modal')

<div id="@yield('editmodalid','editrecordmodal')" class="modal fade" role="dialog">
  <div class="modal-dialog @yield('modal_size','modal-sm')">

        <div class="editrecorddata"></div> 

  </div>
</div>


@endsection('admin_content')

@section('more_scripts')
@include('layouts.admin_scripts')



@endsection('more_scripts')

