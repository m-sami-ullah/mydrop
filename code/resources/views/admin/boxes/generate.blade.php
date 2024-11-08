@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Boxes
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("boxes.index") }}" >Boxes</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('boxes.generate.store')}}" enctype="multipart/form-data"> 

<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button',['title'=>'Generate'])
                @include('layouts.back_button',['back'=>route('boxes.index')])
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}  
                             
        
 
        
<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-5 col-md-6 col-sm-12 control-label">Number of Boxes *</label>
			    <div class="col-lg-7 col-md-6 col-sm-12 {{ $errors->has('number_of_boxes')?'has-error':'' }}">
			        <input   name="number_of_boxes" value="{{ old('number_of_boxes') }}"  class="form-control" id="number_of_boxes" placeholder="Number of Boxes" type="text">
			        			        @if($errors->has('number_of_boxes'))
								    	<p class="help-block">{{ $errors->first('number_of_boxes') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
 
        
<div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-5 col-md-6 col-sm-12 control-label">Number of Doors *</label>
		    <div class="col-lg-7 col-md-6 col-sm-12 {{ $errors->has('boxtype')?'has-error':'' }}">
		    	<select  name="boxtype" class="form-control" id="boxtype" >
		        	{!! $constboxtypeoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('boxtype'))
								    	<p class="help-block">{{ $errors->first('boxtype') }}</p> 
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
    $(document).on("change","#customer_id",function() {
		$("#address_id").html("");
		var customer_id = $(this).val();
		if (customer_id)
		{
			getaddresses(customer_id,{{ old("address_id") }})
		}
		return false;
	});
	getaddresses("{{ old("customer_id") }}","{{ old("address_id") }}")
	function getaddresses(customer_id,address_id)
	{
		$.ajax({
			type: "get",
			url: '{{route("getaddresses")}}',
			data: { customer_id: customer_id,id:address_id },
			success: function(rec){
			$("#address_id").html(rec);
		}
	});
}

})(window.jQuery);   

</script>
@endsection