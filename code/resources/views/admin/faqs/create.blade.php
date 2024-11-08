@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Faqs
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("faqs.index") }}" >Faqs</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">

    @include('layouts.hometabs')

<form class="form-horizontal"   method="post" action="{{route('faqs.store')}}" enctype="multipart/form-data"> 

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('faqs.index')])
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}  
                            
                            <div class="col-lg-12 col-md-12 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-2 col-md-3 col-sm-12 control-label">Question *</label>
			    <div class="col-lg-10 col-md-9 col-sm-12 {{ $errors->has('question')?'has-error':'' }}">
			        <input   name="question" value="{{ old('question') }}"  class="form-control" id="question" placeholder="Question" type="text">
			        			        @if($errors->has('question'))
								    	<p class="help-block">{{ $errors->first('question') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
<div class="col-lg-12 col-md-12 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-2 col-md-3 col-sm-12 control-label">Answer *</label>
		    <div class="col-lg-10 col-sm-9 {{ $errors->has('answer')?'has-error':'' }}">
		    	<textarea   name="answer"   class="form-control summernote" id="answer" >{{ old('answer') }}</textarea>
		    			        @if($errors->has('answer'))
								    	<p class="help-block">{{ $errors->first('answer') }}</p> 
								    @endif
		    </div>
		 	 
		  
		</div>
	</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Status </label>
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