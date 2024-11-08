<form class="form-horizontal" method="post" action="{{route('orderstatuses.update',['orderstatus'=>$orderstatus->id])}}">
    {{csrf_field()}}
    {{ method_field('PATCH') }}
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Order Status</h4>
      </div>
      <div class="modal-body">
        <div class="">
	        <div class="form-group">
			    <label for="" class="col-lg-4 col-md-6 col-sm-12 control-label">Status *</label>
			    <div class="col-lg-8 col-md-6 col-sm-12 {{ $errors->has('name')?'has-error':'' }}">
			        <input   name="name" value="{{ old('name',$orderstatus->name) }}"  class="form-control" id="name" placeholder="Status" type="text">
			        			        @if($errors->has('name'))
								    	<p class="help-block">{{ $errors->first('name') }}</p> 
								    @endif
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
