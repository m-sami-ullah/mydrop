@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Addresses( {{ $customer->firstname  }} )
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("customers.index") }}" >Customers</a></li>
			<li><a href="{{ route("customers.addresses.index",['customer'=>$customer->id]) }}" >Addresses</a></li>

            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

@include('layouts.tabs',['customer'=>$customer])
 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('customers.addresses.store',['customer'=>$customer->id])}}" enctype="multipart/form-data"> 
<div id="tab1" class="tab-pane fade active in">
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel">
	            <header class="panel-heading panel-border">
	                @include('layouts.save_button')
	                @include('layouts.back_button',['back'=>route('customers.addresses.index',['customer'=>$customer->id])])
	            </header>

	            <div class="panel-body">
	                <div class="row"> 
	                    <div class="col-md-12">
	                        
	                            {{ csrf_field() }}  
	                            
	                            <div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Title *</label>
			    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('title')?'has-error':'' }}">
			        <input   name="title" value="{{ old('title') }}"  class="form-control" id="title" placeholder="Title" type="text">
			        		        @if($errors->has('title'))
		    	<p class="help-block">{{ $errors->first('title') }}</p> 
		    @endif
			       

			    </div>
			 
			  
			</div>
	        
	<div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">State *</label>
			    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('state_id')?'has-error':'' }}">
			    	<select  name="state_id" class="form-control" id="state_id" >
			        	{!! $stateoptions !!}
			    		
			    	</select>
			    			        @if($errors->has('state_id'))
		    	<p class="help-block">{{ $errors->first('state_id') }}</p> 
		    @endif
			    </div>
			 	 
			  
			</div>
	        
	<div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">City *</label>
			    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('city_id')?'has-error':'' }}">
			    	<select  name="city_id" class="form-control" id="city_id" >
			        	{!! $cityoptions !!}
			    		
			    	</select>
			    			        @if($errors->has('city_id'))
		    	<p class="help-block">{{ $errors->first('city_id') }}</p> 
		    @endif
			    </div>
			 	 
			  
			</div>
	        
	<div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Area *</label>
			    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('area_id')?'has-error':'' }}">
			    	<select  name="area_id" class="form-control" id="area_id" >
			        	{!! $areaoptions !!}
			    		
			    	</select>
			    			        @if($errors->has('area_id'))
		    	<p class="help-block">{{ $errors->first('area_id') }}</p> 
		    @endif
			    </div>
			 	 
			  
			</div>
	        
	<div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Post Code </label>
			    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('postcode')?'has-error':'' }}">
			        <input   name="postcode" value="{{ old('postcode') }}"  class="form-control" id="postcode" placeholder="Post Code" type="text">
			        		        @if($errors->has('postcode'))
		    	<p class="help-block">{{ $errors->first('postcode') }}</p> 
		    @endif
			       

			    </div>
			 
			  
			</div>
	        
	<div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Address </label>
			    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('streetaddress')?'has-error':'' }}">
			        <textarea   name="streetaddress"   class="form-control" id="streetaddress" >{{ old('streetaddress') }}</textarea>
			        		        @if($errors->has('streetaddress'))
		    	<p class="help-block">{{ $errors->first('streetaddress') }}</p> 
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