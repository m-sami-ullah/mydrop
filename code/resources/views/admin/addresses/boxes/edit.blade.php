@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Box
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("customers.index") }}" >Customers</a></li>
			<li><a href="{{ route("customers.addresses.index",['customer'=>$customer->id]) }}" >Addresses</a></li>
			<li><a href="{{ route("customers.addresses.boxes.index",['customer'=>$customer->id,'address'=>$address->id]) }}" >Boxes</a></li>

            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')

@include('layouts.tabs',['customer'=>$customer])
 <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/summernote/dist/summernote.css') }}">
<form class="form-horizontal"   method="post" action="{{route('customers.addresses.boxes.update',['customer'=>$customer->id,'address'=>$address->id,'box'=>$box->id])}}" enctype="multipart/form-data"> 
<div id="tab1" class="tab-pane fade active in">
	<div class="row">
	    <div class="col-md-12">
	        <div class="panel">
	            <header class="panel-heading panel-border">
	                @include('layouts.save_button')
	                @include('layouts.back_button',['back'=>route('customers.addresses.boxes.index',['customer'=>$customer->id,'address'=>$address->id])])
	            </header>

	            <div class="panel-body">
	                <div class="row"> 
	                    <div class="col-md-12">
	                        
	                        {{ csrf_field() }}
	                            {{ method_field('PATCH') }}
	                            
	                           
	        
		<div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Switch *</label>
			    <div class="col-lg-6 col-md-8 col-sm-12 {{ $errors->has('switch_id')?'has-error':'' }}">
			    	<select  name="switch_id" class="form-control" id="switch_id" >
			        	{!! $switches !!}
			    		
			    	</select>
			    			        @if($errors->has('switch_id'))
		    	<p class="help-block">{{ $errors->first('switch_id') }}</p> 
		    @endif
			    </div>
			 	 
			  
			</div>
	        
	<div class="form-group">
			    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Camera *</label>
			    <div class="col-lg-6 col-md-8 col-sm-12 {{ $errors->has('camera_id')?'has-error':'' }}">
			    	<select  name="camera_id" class="form-control" id="camera_id" >
			        	{!! $cameras !!}
			    		
			    	</select>
			    			        @if($errors->has('camera_id'))
		    	<p class="help-block">{{ $errors->first('camera_id') }}</p> 
		    @endif
			    </div>
			 	 
			  
			</div>
		<div class="form-group">
		    <label for="" class="col-lg-2 col-md-12 col-sm-12 control-label">Status *</label>
		    <div class="col-lg-6 col-md-8 col-sm-12 {{ $errors->has('status')?'has-error':'' }}">
		    	<select  name="status" class="form-control" id="status" >
		        	{!! $statusoptions !!}
		    		
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
