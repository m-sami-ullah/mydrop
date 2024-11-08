@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Countries
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("countries.index") }}" >Countries</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('countries.update',['country'=>$country->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('countries.index')])
            </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Name *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
			        <input   name="name" value="{{ old('name',$country->name) }}"  class="form-control" id="name" placeholder="Name" type="text">
			        			        @if($errors->has('name'))
								    	<p class="help-block">{{ $errors->first('name') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">ISO *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('iso')?'has-error':'' }}">
			        <input   name="iso" value="{{ old('iso',$country->iso) }}"  class="form-control" id="iso" placeholder="ISO" type="text">
			        			        @if($errors->has('iso'))
								    	<p class="help-block">{{ $errors->first('iso') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Nick Name *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('nicename')?'has-error':'' }}">
			        <input   name="nicename" value="{{ old('nicename',$country->nicename) }}"  class="form-control" id="nicename" placeholder="Nick Name" type="text">
			        			        @if($errors->has('nicename'))
								    	<p class="help-block">{{ $errors->first('nicename') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">ISO 3 Character Code </label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('iso3')?'has-error':'' }}">
			        <input   name="iso3" value="{{ old('iso3',$country->iso3) }}"  class="form-control" id="iso3" placeholder="ISO 3 Character Code" type="text">
			        			        @if($errors->has('iso3'))
								    	<p class="help-block">{{ $errors->first('iso3') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Number Code </label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('numcode')?'has-error':'' }}">
			        <input   name="numcode" value="{{ old('numcode',$country->numcode) }}"  class="form-control" id="numcode" placeholder="Number Code" type="number">
			         			        @if($errors->has('numcode'))
								    	<p class="help-block">{{ $errors->first('numcode') }}</p> 
								    @endif
			       

			    </div>
			</div>
		</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Phone Code *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('phonecode')?'has-error':'' }}">
			        <input   name="phonecode" value="{{ old('phonecode',$country->phonecode) }}"  class="form-control" id="phonecode" placeholder="Phone Code" type="number">
			         			        @if($errors->has('phonecode'))
								    	<p class="help-block">{{ $errors->first('phonecode') }}</p> 
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

