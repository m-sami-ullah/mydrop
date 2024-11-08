@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Customers
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("customers.index") }}" >Customers</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

<ul class="nav nav-tabs">
    <li class="active"><a href="javascript::return">Basic Info</a></li>
    <li><a href="javascript::return">Addresses</a></li>
    <li class=""><a href="javascript::return">Devices</a></li>
</ul>
 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('customers.store')}}" enctype="multipart/form-data"> 
<div id="tab1" class="tab-pane fade active in">
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel">
	            <header class="panel-heading panel-border">
	                @include('layouts.save_button')
	                @include('layouts.back_button',['back'=>route('customers.index')])
	            </header>

	            <div class="panel-body">
	                <div class="row"> 
	                    <div class="col-md-12">
	                        
	                            {{ csrf_field() }}  
	                <div class="col-lg-6 col-md-6 col-sm-12">        
	                	<div class="form-group">
						    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">First Name *</label>
						    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('firstname')?'has-error':'' }}">
						        <input   name="firstname" value="{{ old('firstname') }}"  class="form-control" id="firstname" placeholder="First Name" type="text">
						        		        @if($errors->has('firstname'))
							    	<p class="help-block">{{ $errors->first('firstname') }}</p> 
							    @endif
						    </div>
						</div>
					</div>
		<div class="col-lg-6 col-md-6 col-sm-12">        
			<div class="form-group">
			    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Last Name *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('lastname')?'has-error':'' }}">
			        <input   name="lastname" value="{{ old('lastname') }}"  class="form-control" id="lastname" placeholder="Last Name" type="text">
			        		        @if($errors->has('lastname'))
		    	<p class="help-block">{{ $errors->first('lastname') }}</p> 
		    @endif
			       

			    </div>
			 
			  
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">        
			<div class="form-group">
			    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Email *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('email')?'has-error':'' }}">
			        <input   name="email" value="{{ old('email') }}"  class="form-control" id="email" placeholder="Email" type="email">
			         		        @if($errors->has('email'))
		    	<p class="help-block">{{ $errors->first('email') }}</p> 
		    @endif
			       

			    </div>
			 
			  
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">        
			<div class="form-group">
			    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Password *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('password')?'has-error':'' }}">
			        <input   name="password" value="{{ old('password') }}"  class="form-control" id="password" placeholder="Password" type="password">
			         		        @if($errors->has('password'))
		    	<p class="help-block">{{ $errors->first('password') }}</p> 
		    @endif
			       

			    </div>
			 
			  
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">        
			<div class="form-group">
			    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Phone Number </label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('phone')?'has-error':'' }}">
			        <input   name="phone" value="{{ old('phone') }}"  class="form-control" id="phone" placeholder="Phone Number" type="text">
			        		        @if($errors->has('phone'))
		    	<p class="help-block">{{ $errors->first('phone') }}</p> 
		    @endif
			       

			    </div>
			 
			  
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12">        
			<div class="form-group">
			    <label for="" class="col-lg-4 col-md-12 col-sm-12 control-label">Status </label>
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