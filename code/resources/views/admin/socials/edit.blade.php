@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Social media
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route('socials.index') }}" >Social media</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
@include('layouts.hometabs')
<form class="form-horizontal"   method="post" action="{{route('socials.update', ['social'=>$social->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('socials.index')])
            </header>

            <div class="panel-body">
                <div class="row">

 

                    <div class="col-md-12">
                    
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                               
                            @php
                                $_help = '<a href="https://iconscout.com/unicons/explore/line" target="_blank">Copy Name of unicons from here</a>';
                            @endphp
                            @include('layouts.input',['title'=>'Font Awesome','name'=>'icon','value'=>$social->icon,'help'=>$_help])  
                            @include('layouts.input',['title'=>'Link','name'=>'link','value'=>$social->link,'type'=>'link'])  
                            
                            <div class="form-group">
                                <label for="" class="col-lg-2 col-sm-3 control-label">@lang('Status')</label>
                                <label >Enable
                                    <input type="radio" {{ old('status',$social->status)==1 ? 'checked':'' }} name="status" value="1"  class=" "/>
                                </label>
                                <label >Disable
                                 <input type="radio" {{ old('status',$social->status)==0 ? 'checked':'' }} name="status" value="0"  class=" "/>
                                 </label>
                                  
                              
                            </div>
                            

                           
                        
                              
                              
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     
</form>
@endsection('admin_content')
