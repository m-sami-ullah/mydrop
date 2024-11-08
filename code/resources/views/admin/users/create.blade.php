@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Users
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("users.index") }}" >Users</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('users.store')}}" enctype="multipart/form-data"> 

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('users.index')])
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}  
                            
		<div class="col-lg-6 col-md-12 col-sm-12 ">
			
            <div class="form-group">
			    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Full Name *</label>
			    <div class="col-lg-8 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name') }}"  class="form-control" id="name" placeholder="Full Name" type="text">
		        @if($errors->has('name'))
	    			<p class="help-block">{{ $errors->first('name') }}</p> 
	    		@endif
		    </div>
		 
		  
			</div>
		</div>                            
        
		<div class="col-lg-6 col-md-12 col-sm-12 ">
			<div class="form-group">
			    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Email Address *</label>
			    <div class="col-lg-8 col-md-12 col-sm-12 {{ $errors->has('email')?'has-error':'' }}">
			        <input   name="email" value="{{ old('email') }}"  class="form-control" id="email" placeholder="Email Address" type="email">
			         		        @if($errors->has('email'))
		    			<p class="help-block">{{ $errors->first('email') }}</p> 
		    		@endif
		       

		    </div>
		  
			</div>
		 </div>
    
    <div class="col-lg-6 col-md-12 col-sm-12 ">

		<div class="form-group">
		    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Password *</label>
		    <div class="col-lg-8 col-md-12 col-sm-12 {{ $errors->has('password')?'has-error':'' }}">
		        <input   name="password" value="{{ old('password') }}"  class="form-control" id="password" placeholder="Password" type="password">
		         		        @if($errors->has('password'))
	    	<p class="help-block">{{ $errors->first('password') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
	</div>
	<div class="col-lg-6 col-md-12 col-sm-12 ">        
		<div class="form-group">
		    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Status *</label>
		    <div class="col-lg-8 col-md-12 col-sm-12 {{ $errors->has('activated')?'has-error':'' }}">
		    	<select  name="activated" class="form-control" id="activated" >
		        	{!! $constactivatedoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('activated'))
	    	<p class="help-block">{{ $errors->first('activated') }}</p> 
	    @endif
		    </div>
		 	 
		  
		</div>
	</div>
	<div class="col-lg-6 col-md-12 col-sm-12 ">        
		<div class="form-group">
		    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Group *</label>
		    <div class="col-lg-8 col-md-12 col-sm-12 {{ $errors->has('group_id[]')?'has-error':'' }}">
		    	<select  name="group_id[]" class="form-control select2" multiple="multiple" id="group_id[]" >
		        	{!! $group_useroptions !!}
		    		
		    	</select>
		    			        @if($errors->has('group_id[]'))
	    	<p class="help-block">{{ $errors->first('group_id[]') }}</p> 
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