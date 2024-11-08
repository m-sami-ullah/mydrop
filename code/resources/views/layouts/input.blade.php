@php
	$title = isset($title) ? $title:'';
	$element = isset($code) ?  $name.'.'.$code : $name;
	$element = isset($errorbag) ?  $errorbag : $element;
	$name  = isset($code) ? $name.'['.$code.']' : $name;
	$value = isset($value) ? old($element,$value): old($element);
	$type  = isset($type) ? $type : 'input';
	$options  = isset($options) ? $options : '';
	$class  = isset($class) ? $class : '';
	$attribute  = isset($attribute) ? $attribute : '';
	$help  = isset($help) ? $help : '';
	$container_class  = isset($container_class) ? $container_class : '';
	$checked  = isset($checked) && $checked==1 ? 'checked' : '';
@endphp

@switch($type)
    @case('input')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		        <input  {{ $attribute }} name="{{ $name }}" value="{{ $value }}"  class="form-control" id="{{ $name }}" placeholder="@lang($title)" type="text">
		         @if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		       

		    </div>
		 
		  
		</div>
        @break
    @case('number')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		        <input  {{ $attribute }} name="{{ $name }}" value="{{ $value }}"  class="form-control" id="{{ $name }}" placeholder="@lang($title)" type="number">
		         @if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		       

		    </div>
		 
		  
		</div>
        @break
    @case('date')
 
        <div class="form-group {{ $container_class }}" >
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		    	<div class="input-group date date_picker">
		        	<input  {{ $attribute }} name="{{ $name }}" value="{{ $value }}"  class="form-control" id="{{ $name }}" type="text" data-date-format="dd-mm-yyyy">
		        <span class="input-group-addon"><i class="glyphicon glyphicon-th fa fa-calendar"></i></span>
		        </div>
		         @if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		       

		    </div>
		 
		  
		</div>
        @break
    @case('link')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		        <input   {{ $attribute }} name="{{ $name }}" value="{{ $value }}"  class="form-control" id="{{ $name }}" placeholder="@lang($title)" type="url">
		         @if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		       

		    </div>
		 
		  
		</div>
        @break
    @case('checkbox')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		        <input  {{ $attribute }} name="{{ $name }}" value="{{ $value ? $value :1}}"  {{ $checked }}  class="" id="{{ $name }}" placeholder="@lang($title)" type="checkbox">
		        @if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 

		    </div>
		 
		  
		</div>
        @break
    @case('textarea')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		        <textarea  {{ $attribute }} name="{{ $name }}"   class="form-control" id="{{ $name }}" >{{ $value }}</textarea>
		        @if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		    </div>
		 
		  
		</div>
        @break
	@case('file')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		        <input  {{ $attribute }} name="{{ $name }}" value="{{ $value }}"  class="form-control" id="{{ $name }}" placeholder="@lang($title)" type="file">
		        @if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		    </div>
		    <div class="col-lg-10">
	        	<img height="70" src="{{ $value }}">  
		    </div>
		 	 
		  
		</div>
        @break
    @case('select')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		    	<select {{ $attribute }} name="{{ $name }}" class="form-control" id="{{ $name }}" >
		        	{!! $options !!}
		    		
		    	</select>
		    	@if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		    </div>
		 	 
		  
		</div>
        @break

        @case('select2')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 {{ $errors->has($element)?'has-error':'' }}">
		    	<select {{ $attribute }} name="{{ $name }}" class="form-control {{ $class }}" multiple="multiple" id="{{ $name }}" >
		        	{!! $options !!}
		    		
		    	</select>
		    	@if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		    </div>
		 	 
		  
		</div>
        @break

        @case('texteditor')
        <div class="form-group">
		    <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
		    <div class="col-lg-10 col-sm-9 {{ $errors->has($element)?'has-error':'' }}">
		    	<textarea  {{ $attribute }} name="{{ $name }}"   class="form-control summernote" id="{{ $name }}" >{{ $value }}</textarea>
		    	@if ($help)
		        	<span class="form-text text-muted ">{!! $help !!}</span>
		        @endif
		        @if($errors->has($element))
		        <p class="help-block">{{ $errors->first($element) }}</p> 
		        @endif 
		    </div>
		 	 
		  
		</div>
        @break



    @case('status')

    <div class="form-group">
        <label for="" class="col-lg-2 col-sm-3 control-label">@lang($title)</label>
        <label >Enable
            <input type="radio" {{ old('status',$value)==1 ? 'checked':'' }} {{ $attribute }} name="{{ $name }}" value="1"   class=" "/>
        </label>
        <label >Disable
         <input type="radio" {{ old('status',$value)==0 ? 'checked':'' }} {{ $attribute }} name="{{ $name }}" value="0"   class=" "/>
         </label>
       @if ($help)
    		<span class="form-text text-muted ">{!! $help !!}</span>
    	@endif   
      
    </div>
         
        @break
    
    @default
@endswitch

