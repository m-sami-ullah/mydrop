@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Packages
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("packages.index") }}" >Packages</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('packages.update',['package'=>$package->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('packages.index')])
            </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Package Name *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name',$package->name) }}"  class="form-control" id="name" placeholder="Package Name" type="text">
		        		        @if($errors->has('name'))
	    	<p class="help-block">{{ $errors->first('name') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
	        <div class="form-group">
			    <label for="" class="col-lg-2 col-md-3 col-sm-12 control-label">Slug *</label>
			    <div class="col-lg-10 col-md-9 col-sm-12 {{ $errors->has('slug')?'has-error':'' }}">
			        <input   name="slug" value="{{ old('slug',$package->slug) }}"  class="form-control" id="slug" placeholder="Slug" type="text">
			        			        @if($errors->has('slug'))
								    	<p class="help-block">{{ $errors->first('slug') }}</p> 
								    @endif
			    </div>
			</div>
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Description </label>
		    <div class="col-lg-10 col-sm-9 {{ $errors->has('description')?'has-error':'' }}">
		    	<textarea   name="description"   class="form-control summernote" id="description" >{{ old('description',$package->description) }}</textarea>
		    			        @if($errors->has('description'))
	    	<p class="help-block">{{ $errors->first('description') }}</p> 
	    @endif
		    </div>
		 	 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Price *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('price')?'has-error':'' }}">
		        <input  step=&quot;.01&quot; name="price" value="{{ old('price',$package->price) }}"  class="form-control" id="price" placeholder="Price" type="number">
		         		        @if($errors->has('price'))
	    	<p class="help-block">{{ $errors->first('price') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Duration *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('duration')?'has-error':'' }}">
		    	<input  step="1" name="duration" value="{{ old('duration',$package->duration) }}"  class="form-control" id="duration" placeholder="Duration" type="number">
		    	 
		   	@if($errors->has('duration'))
		    	<p class="help-block">{{ $errors->first('duration') }}</p> 
		    @endif
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

