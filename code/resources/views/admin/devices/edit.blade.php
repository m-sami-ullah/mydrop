@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Devices
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("devices.index") }}" >Devices</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('devices.update',['device'=>$device->id])}}" enctype="multipart/form-data">
<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('devices.index')])
            </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
               
               <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Device Type *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('type')?'has-error':'' }}">
		    	<select  name="type" class="form-control" id="type" >
		        	{!! $consttypeoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('type'))
	    	<p class="help-block">{{ $errors->first('type') }}</p> 
	    @endif
		    </div>
		 	 
		  
		</div> 

                            <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Name *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name',$device->name) }}"  class="form-control" id="name" placeholder="Name" type="text">
		        		        @if($errors->has('name'))
	    	<p class="help-block">{{ $errors->first('name') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">FCC ID *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('deviceid')?'has-error':'' }}">
		        <input   name="deviceid" value="{{ old('deviceid',$device->deviceid) }}"  class="form-control" id="deviceid" placeholder="FCC ID" type="text">
		        		        @if($errors->has('deviceid'))
	    	<p class="help-block">{{ $errors->first('deviceid') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>

	 <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Device Port</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('port')?'has-error':'' }}">
		        <input   name="port" value="{{ old('port',$device->port) }}"  class="form-control" id="port" placeholder="Device Port" type="text">
		        		        @if($errors->has('port'))
	    	<p class="help-block">{{ $errors->first('port') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
    <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Device Model </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('model')?'has-error':'' }}">
		        <input   name="model" value="{{ old('model',$device->model) }}"  class="form-control" id="model" placeholder="Device Model" type="text">
		        		        @if($errors->has('model'))
	    	<p class="help-block">{{ $errors->first('model') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div> 

	  
	{{-- <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Device IP *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('ip')?'has-error':'' }}">
		        <input   name="ip" value="{{ old('ip',$device->ip) }}"  class="form-control" id="ip" placeholder="Device IP" type="text">
		        		        @if($errors->has('ip'))
	    	<p class="help-block">{{ $errors->first('ip') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        

        
<div class="form-group " >
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Installation Date </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('install')?'has-error':'' }}">
		    	<div class="input-group date date_picker">
		        	<input   name="install" value="{{ old('install',$device->install) }}"  class="form-control" id="install" type="text" data-date-format="dd-mm-yyyy">
		        <span class="input-group-addon"><i class="glyphicon glyphicon-th fa fa-calendar"></i></span>
		        </div>
		         		        @if($errors->has('install'))
	    	<p class="help-block">{{ $errors->first('install') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Channenls </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('channels')?'has-error':'' }}">
		        <input   name="channels" value="{{ old('channels',$device->channels) }}"  class="form-control" id="channels" placeholder="Channenls" type="text">
		        		        @if($errors->has('channels'))
	    	<p class="help-block">{{ $errors->first('channels') }}</p> 
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
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Installed </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('installed')?'has-error':'' }}">
		        <input   name="installed" value="{{ old('installed',$device->installed) }}"    class="" id="installed" placeholder="Installed" type="checkbox">
		        		        @if($errors->has('installed'))
	    	<p class="help-block">{{ $errors->first('installed') }}</p> 
	    @endif

		    </div>
		 
		  
		</div> --}}
        
                           
                        
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

