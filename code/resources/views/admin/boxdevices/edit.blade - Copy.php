@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Boxdevices( {{ $box->boxnumber  }} )
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("boxes.index") }}" >Boxes</a></li>
			<li><a href="{{ route("boxes.boxdevices.index",['box'=>$box->id]) }}" >Boxdevices</a></li>

            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('boxes.boxdevices.update',['boxdevice'=>$boxdevice->id,'box'=>$box->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('boxes.boxdevices.index',['box'=>$box->id])])
            </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Device *</label>
		    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('device_id')?'has-error':'' }}">
		    	<select  name="device_id" class="form-control" id="device_id" >
		        	{!! $deviceoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('device_id'))
								    	<p class="help-block">{{ $errors->first('device_id') }}</p> 
								    @endif
		    </div>
		 	 
		  
		</div>
	</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Status *</label>
		    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('status')?'has-error':'' }}">
		    	<select  name="status" class="form-control" id="status" >
		        	{!! $conststatusoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('status'))
								    	<p class="help-block">{{ $errors->first('status') }}</p> 
								    @endif
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

