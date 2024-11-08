@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Banners
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("banners.index") }}" >Banners</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">

    @include('layouts.hometabs')

<form class="form-horizontal"   method="post" action="{{route('banners.update',['banner'=>$banner->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('banners.index')])
            </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Title *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name',$banner->name) }}"  class="form-control" id="name" placeholder="Title" type="text">
		        		        @if($errors->has('name'))
	    	<p class="help-block">{{ $errors->first('name') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Button Title </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('btntitle')?'has-error':'' }}">
		        <input   name="btntitle" value="{{ old('btntitle',$banner->btntitle) }}"  class="form-control" id="btntitle" placeholder="Button Title" type="text">
		        		        @if($errors->has('btntitle'))
	    	<p class="help-block">{{ $errors->first('btntitle') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Description </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('description')?'has-error':'' }}">
		        <textarea   name="description"   class="form-control" id="description" >{{ old('description',$banner->description) }}</textarea>
		        		        @if($errors->has('description'))
	    	<p class="help-block">{{ $errors->first('description') }}</p> 
	    @endif
		    </div>
		 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Status </label>
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
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Image </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('image')?'has-error':'' }}">
		        <input   name="image" value="{{ old('image',$banner->getimage()) }}"  class="form-control" id="image" placeholder="Image" type="file">
		        		        @if($errors->has('image'))
	    	<p class="help-block">{{ $errors->first('image') }}</p> 
	    @endif
		    </div>
		    <div class="col-lg-9 col-md-12 col-sm-12">
	        	<img height="70" src="{{ old('image',$banner->getimage()) }}">  
		    </div>
		 	 
		  
		</div>
        
<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Link </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('link')?'has-error':'' }}">
		        <input   name="link" value="{{ old('link',$banner->link) }}"  class="form-control" id="link" placeholder="Link" type="text">
		        		        @if($errors->has('link'))
	    	<p class="help-block">{{ $errors->first('link') }}</p> 
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

