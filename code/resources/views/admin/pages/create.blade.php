@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Pages
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("pages.index") }}" >Pages</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('pages.store')}}" enctype="multipart/form-data"> 

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('pages.index')])
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}  
                            
                            <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Title *</label>
		    <div class="col-lg-10 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name') }}"  class="form-control" id="name" placeholder="Title" type="text">
		        		        @if($errors->has('name'))
	    	<p class="help-block">{{ $errors->first('name') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
	        <div class="form-group">
			    <label for="" class="col-lg-2 col-md-3 col-sm-12 control-label">Slug  *</label>
			    <div class="col-lg-10 col-md-9 col-sm-12 {{ $errors->has('slug')?'has-error':'' }}">
			        <input   name="slug" value="{{ old('slug') }}"  class="form-control" id="slug" placeholder="Slug" type="text">
			        			        @if($errors->has('slug'))
								    	<p class="help-block">{{ $errors->first('slug') }}</p> 
								    @endif
			    </div>
			</div>
		<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Short Description *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('short_description')?'has-error':'' }}">
		        <textarea   name="short_description"  class="form-control" >{{ old('short_description') }}</textarea>
				@if($errors->has('name'))
	    			<p class="help-block">{{ $errors->first('short_description') }}</p> 
	    		@endif
		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Description *</label>
		    <div class="col-lg-10 col-sm-9 {{ $errors->has('description')?'has-error':'' }}">
		    	<textarea   name="description"   class="form-control summernote" id="description" >{{ old('description') }}</textarea>
		    			        @if($errors->has('description'))
	    	<p class="help-block">{{ $errors->first('description') }}</p> 
	    @endif
		    </div>
		 	 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Banner </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('image')?'has-error':'' }}">
		        <input   name="image" value="{{ old('image') }}"  class="form-control" id="image" placeholder="Banner" type="file">
		        		        @if($errors->has('image'))
	    	<p class="help-block">{{ $errors->first('image') }}</p> 
	    @endif
		    </div>
		    <div class="col-lg-9 col-md-12 col-sm-12">
	        	<img height="70" src="{{ old('image') }}">  
		    </div>
		 	 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Status </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('status')?'has-error':'' }}">
		        <input   name="status" value="{{ old('status',1) }}"  checked  class="" id="status" placeholder="Status" type="checkbox">
		        		        @if($errors->has('status'))
	    	<p class="help-block">{{ $errors->first('status') }}</p> 
	    @endif

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Meta title </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('meta_title')?'has-error':'' }}">
		        <input   name="meta_title" value="{{ old('meta_title') }}"  class="form-control" id="meta_title" placeholder="Meta title" type="text">
		        		        @if($errors->has('meta_title'))
	    	<p class="help-block">{{ $errors->first('meta_title') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Keywords </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('keywords')?'has-error':'' }}">
		        <input   name="keywords" value="{{ old('keywords') }}"  class="form-control" id="keywords" placeholder="Keywords" type="text">
		        		        @if($errors->has('keywords'))
	    	<p class="help-block">{{ $errors->first('keywords') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Meta Description </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('meta_description')?'has-error':'' }}">
		        <textarea   name="meta_description"   class="form-control" id="meta_description" >{{ old('meta_description') }}</textarea>
		        		        @if($errors->has('meta_description'))
	    	<p class="help-block">{{ $errors->first('meta_description') }}</p> 
	    @endif
		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Robots </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('robots')?'has-error':'' }}">
		    	<select  name="robots" class="form-control" id="robots" >
		        	{!! $constrobotsoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('robots'))
	    	<p class="help-block">{{ $errors->first('robots') }}</p> 
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
	

	create_slug('name','slug','meta_title')

})(window.jQuery);   

function create_slug(titleid,slugid,metatitleid) 
	{
		$('#'+titleid).on('change',function(){
	 
		var title= document.getElementById(titleid);

		var slug = document.getElementById(slugid);
		var mtitleee = document.getElementById(metatitleid);
	 
		 
		title = title.value;
		 
		var page= title.replace(/[^a-zA-Z]+/ig, '-');
		//page=page.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');     
	  	// page=page.replace(/[^a-zA-Z-]/g, ''); 
		//   page=page.replace(/ /g, '-');
	   
	  	page=page.replace(/-$/, '');;
	  	page=page.replace(/^-/, '');;
		page= page.toLowerCase();

	 	slug.value = page;
	 	mtitleee.value = title;
	 
		});
	}
</script>
@endsection