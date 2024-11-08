@php
    $mt = isset($mt)? $mt:NULL;
    $mk = isset($mk)? $mk:NULL;
    $md = isset($md)? $md:NULL;
    $mr = isset($mr)? $mr:'noindex,nofollow';
@endphp
<div class="form-group">
    <label for="" class="col-lg-2 col-sm-3 control-label">@lang('Meta title')</label>
    <div class="col-lg-4 {{ $errors->has('meta_title')?'has-error':'' }}">
        <input  name="meta_title" value="{{ old('meta_title',$mt) }}"  class="form-control" id="meta_title" placeholder="@lang('Meta title')" type="text">
        @if($errors->has('meta_title'))
        <p class="help-block">{{ $errors->first('meta_title') }}</p> 
        @endif 
    </div>
 
  
</div>

<div class="form-group">
    <label for="" class="col-lg-2 col-sm-3 control-label">@lang('Keywords')</label>
    <div class="col-lg-4 {{ $errors->has('keywords')?'has-error':'' }}">
        <input  name="keywords" value="{{ old('keywords',$mk) }}"  class="form-control" id="keywords" placeholder="@lang('Keywords')" type="text">
        @if($errors->has('keywords'))
        <p class="help-block">{{ $errors->first('keywords') }}</p> 
        @endif 
    </div>
 
  
</div>
<div class="form-group">
    <label for="" class="col-lg-2 col-sm-3 control-label">@lang('Meta Description')</label>
    <div class="col-lg-4 {{ $errors->has('meta_description')?'has-error':'' }}">
        <textarea  name="meta_description"  class="form-control" id="meta_description">{{ old('meta_description',$md) }}</textarea>
        @if($errors->has('meta_description'))
        <p class="help-block">{{ $errors->first('meta_description') }}</p> 
        @endif 
    </div>
 
  
</div>
	<div class="form-group">
        <label for="" class="col-lg-2 col-sm-3 control-label">@lang('Robots')</label>
        <label >Index
            <input type="radio" {{ old('robots',$mr)=='index,nofollow' ? 'checked':'' }} name="robots" value="index,nofollow" class=" "/>
        </label>
        <label >Follow
         <input type="radio" {{ old('robots',$mr)=='noindex,follow' ? 'checked':'' }} name="robots" value="noindex,follow" class=" "/>
         </label>
         <label >Disallow
            <input type="radio" {{ old('robots',$mr,'noindex,nofollow')=='noindex,nofollow' ? 'checked':'' }} name="robots" value="noindex,nofollow" class=" "/>
         </label>
         <label >Allow
            <input type="radio" {{ old('robots',$mr)=='index,follow' ? 'checked':'' }}  name="robots" value="index,follow" class=" "/>
         </label>
      
    </div>