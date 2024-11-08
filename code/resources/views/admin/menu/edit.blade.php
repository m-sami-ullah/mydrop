@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Menu
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route('nav.index') }}" >Menu</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<form class="form-horizontal"   method="post" action="{{route('nav.update', ['nav'=>$nav->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
                @include('layouts.back_button',['back'=>route('nav.index')])
            </header>

            <div class="panel-body">
                <div class="row">

 

                    <div class="col-md-12">
                    
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            @foreach ($languages as $lang)

                                @php
                                    $translate = $nav->translate($lang->code);
                                    $name = $translate ? $translate->title : NULL; 
                                @endphp

                                @section('language_content_'.$lang->id)

                                    @include('layouts.input',['title'=>'Title','code'=>$lang->code,'name'=>'title','value'=>$name])

                                @endsection

                            @endforeach 
                            
                                
    
@include('layouts.lang_tabs')
@include('layouts.tab_content')    
                            
                            @include('layouts.input',['title'=>'Active','name'=>'status','checked'=>$nav->status,'type'=>'checkbox'])
                              
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     
</form>
@endsection('admin_content')
