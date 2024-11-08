@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Features( {{ $package->name  }} )
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("packages.index") }}" >Packages</a></li>
			<li><a href="{{ route("packages.features.index",['package'=>$package->id]) }}" >Features</a></li>

            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('packages.features.store',['package'=>$package->id])}}" enctype="multipart/form-data"> 

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('packages.features.index',['package'=>$package->id])])
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}  
                            
        <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Feature *</label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name') }}"  class="form-control" id="name" placeholder="Feature" type="text">
		        		        @if($errors->has('name'))
	    	<p class="help-block">{{ $errors->first('name') }}</p> 
	    @endif
		       

		    </div>
		 
		  
		</div>
        <div class="form-group">
                <label class="col-sm-2 control-label">Available</label>
                <div class="col-lg-8">
                    <label class="radio-inline i-checks">
                        <input name="available" id="inlineRadio1" value="1" checked="" type="radio">
                        <i></i> Yes
                    </label>
                    <label class="radio-inline i-checks">
                        <input name="available" id="inlineRadio12" value="2" type="radio">
                        <i></i> No
                    </label>
                    
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