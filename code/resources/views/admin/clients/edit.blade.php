<form class="form-horizontal" method="post" action="{{route('clients.update',['client'=>$client->id])}}">
    {{csrf_field()}}
    {{ method_field('PATCH') }}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Client</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Title *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
			        <input   name="name" value="{{ old('name',$client->name) }}"  class="form-control" id="name" placeholder="Title" type="text">
			        			        @if($errors->has('name'))
								    	<p class="help-block">{{ $errors->first('name') }}</p> 
								    @endif
			    </div>
			</div>
		</div>
        
<div class="col-lg-6 col-md-6 col-sm-12">
        <div class="form-group">
		    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Logo *</label>
		    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('logo')?'has-error':'' }}">
		        <input   name="logo" value="{{ old('logo',$client->getlogo()) }}"  class="form-control" id="logo" placeholder="Logo" type="file">
		        		        @if($errors->has('logo'))
								    	<p class="help-block">{{ $errors->first('logo') }}</p> 
								    @endif
		    </div>
		    <div class="col-lg-8 col-md-6 col-sm-12">
	        	<img height="70" src="{{ old('logo',$client->getlogo()) }}">  
		    </div>
		 	 
		  
		</div>
	</div>
        
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info" >Save</button>
      </div>
    </div>
</form>
