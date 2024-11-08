@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Areas
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("areas.index") }}" >Areas</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('areas.store')}}" enctype="multipart/form-data"> 

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('areas.index')])
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}  
                            
                            <div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">State </label>
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
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">City </label>
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
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Name </label>
		    <div class="col-lg-9 col-md-12 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
		        <input   name="name" value="{{ old('name') }}"  class="form-control" id="name" placeholder="Name" type="text">
		        		        @if($errors->has('name'))
	    	<p class="help-block">{{ $errors->first('name') }}</p> 
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
    $(document).on("change","#state_id",function() {
		$("#city_id").html("");
		var state_id = $(this).val();
		if (state_id)
		{
			getcities(state_id,{{ old("city_id") }})
		}
		return false;
	});
	getcities("{{ old("state_id") }}","{{ old("city_id") }}")
	function getcities(state_id,city_id)
	{
		$.ajax({
			type: "get",
			url: '{{route("getcities")}}',
			data: { state_id: state_id,id:city_id },
			success: function(rec){
			$("#city_id").html(rec);
		}
	});
}

})(window.jQuery);   

</script>
@endsection