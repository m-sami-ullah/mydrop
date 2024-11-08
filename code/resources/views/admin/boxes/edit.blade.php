@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Boxes
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("boxes.index") }}" >Boxes</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('boxes.update',['box'=>$box->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('boxes.index')])
            </header>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Customer *</label>
		    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('customer_id')?'has-error':'' }}">
		    	<select  name="customer_id" class="form-control" id="customer_id" >
		        	{!! $customeroptions !!}
		    		
		    	</select>
		    			        @if($errors->has('customer_id'))
								    	<p class="help-block">{{ $errors->first('customer_id') }}</p> 
								    @endif
		    </div>
		 	 
		  
		</div>
	</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Address *</label>
		    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('address_id')?'has-error':'' }}">
		    	<select  name="address_id" class="form-control" id="address_id" >
		        	{!! $addressoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('address_id'))
								    	<p class="help-block">{{ $errors->first('address_id') }}</p> 
								    @endif
		    </div>
		 	 
		  
		</div>
	</div>
        <div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Title </label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('title')?'has-error':'' }}">
			        <input   name="title" value="{{ old('title',$box->title) }}"  class="form-control" id="title" placeholder="Title" type="text">
			        			        @if($errors->has('title'))
								    	<p class="help-block">{{ $errors->first('title') }}</p> 
								    @endif
			    </div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">IP / External IP </label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('ip')?'has-error':'' }}">
			        <input   name="ip" value="{{ old('ip',$box->ip) }}"  class="form-control" id="ip" placeholder="IP / External IP" type="text">
			        			        @if($errors->has('ip'))
								    	<p class="help-block">{{ $errors->first('ip') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
<div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Box Number *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('boxnumber')?'has-error':'' }}">
			        <input   name="boxnumber" readonly value="{{ old('boxnumber',$box->boxnumber) }}"  class="form-control" id="boxnumber" placeholder="Box Number" type="text">
			        			        @if($errors->has('boxnumber'))
								    	<p class="help-block">{{ $errors->first('boxnumber') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
{{-- <div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">QR Code </label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('qrcode')?'has-error':'' }}">
			        <input   name="qrcode" value="{{ old('qrcode',$box->qrcode) }}"  class="form-control" id="qrcode" placeholder="QR Code" type="text">
			        			        @if($errors->has('qrcode'))
								    	<p class="help-block">{{ $errors->first('qrcode') }}</p> 
								    @endif
			    </div>
			</div>
		</div> --}}
        
<div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Number of Doors *</label>
		    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('boxtype')?'has-error':'' }}">
		    	<select readonly  name="boxtype" class="form-control" id="boxtype" >
		        	{!! $constboxtypeoptions !!}
		    		
		    	</select>
		    			        @if($errors->has('boxtype'))
								    	<p class="help-block">{{ $errors->first('boxtype') }}</p> 
								    @endif
		    </div>
		 	 
		  
		</div>
	</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Status *</label>
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
    $(document).on("change","#customer_id",function() {
		$("#address_id").html("");
		var customer_id = $(this).val();
		if (customer_id)
		{
			getaddresses(customer_id,{{ old("address_id",$box->address_id) }})
		}
		return false;
	});
	getaddresses("{{ old("customer_id",$box->customer_id) }}","{{ old("address_id",$box->address_id) }}")
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

