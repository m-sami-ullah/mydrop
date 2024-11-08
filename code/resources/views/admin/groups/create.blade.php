@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Groups
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("groups.index") }}" >Groups</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('groups.store')}}" enctype="multipart/form-data"> 

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('groups.index')])
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}  
                            
                            <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Name *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name') }}"  class="form-control" id="name" placeholder="Name" type="text">
		        		        @if($errors->has('name'))
	    	<p class="help-block">{{ $errors->first('name') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Status *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('status')?'has-error':'' }}">
		    	<select  name="status" class="form-control" id="status" >
		        	{!! $conststatusoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('status'))
	    	<p class="help-block">{{ $errors->first('status') }}</p> 
	    @endif
		    </div>
		 	 
		  
		</div>
        
				<div class="form-group">
                                <label for="status" class="col-lg-2 col-sm-3 control-label">Permissions</label>
                                <div class="col-md-10">
                                    <div class="checkbox-list">
                                        <!-- <label class="heading">
                                             <input onclick="checkall('setting_all','settings');" type="checkbox" name="testing" class="setting_all">
                                        Permissions</label> -->
                                        <div class="row">
                                            <?php 
                                            foreach($permissionModule as $module) 
                                           {
                                             
                                            ?>                              
                                                <div class="col-md-4">
                                                    <div class="permission_box" ><?php echo $module->name;?> 
                                                    

                                                        <?php foreach($module->permissions as $permission)
                                                        {
                                                            // $group_permission =  $group->permissions->where('id',$permission->id)->first();
                                                            // dd();
                                                            $checked = ''; 
                                                            /*if ($group_permission) 
                                                            {
                                                                
                                                                $checked = $group_permission->pivot->status==1?'checked':'';
                                                            }*/
                                                        ?>
                                                        <div class="checkbox">
                                                            <label class="i-checks">
                                                            <input  type="checkbox" value="<?php echo $permission->id ?>"   name="permission[<?php echo $permission->id ?>]"  <?php  echo $checked;?>> <i></i>
                                                            <?php echo $permission->name?>
                                                            </label>
                                                        </div>
                                                        <?php } ?>
                                                    
                                                    </div>
                                                </div>
                                            <?php 
                                            } 
                                            ?>                               
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
        
  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection('admin_content')
@section('more_scripts')
@parent

<!-- Select2 Dependencies -->
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/select2/dist/css/select2.min.css') }}">
<!-- Select2 Dependencies -->
<script src="{{ URL::asset('admin/bower_components/select2/dist/js/select2.min.js') }}"></script>

<script src="{{ URL::asset('admin/bower_components/summernote/dist/summernote.js') }}"></script>
  <script>

(function($) {

    'use strict';

    $(".select2").select2({
        placeholder: "Select"
    });


    $('.summernote').summernote({
        height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote

    });
    
})(window.jQuery);   

</script>
@endsection