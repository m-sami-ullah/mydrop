@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       @lang('Navs') <small>{{ $nav->title }}</small>
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route('nav.index') }}" >@lang('Navs')</a></li>
            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')
@inject('pages','App\Models\Page')
{{-- @inject('categories','App\Models\Category') --}}
 
<link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/assets/css/jquery.nestable.css') }}">

@include('layouts.hometabs')
<div class="row">
    <div class="col-md-4">
        @include('layout.addPageToMenu')
        {{-- @include('layout.addCategoryToMenu',['hide'=>'true']) --}}
        @include('layout.addCustomLinkToMenu',['hide'=>'true'])

    </div>
    <div class="col-md-8">
        <div class="panel">
            <header class="panel-heading panel-border">
                Menu structure
            </header>

            <div class="panel-body">
                <div class="row"> 
                    <div class="col-md-12">
                    <form class="form-horizontal"   method="post" action="{{route('menu.update', ['nav'=>$nav->id])}}" >

                        Drag each item into the order you prefer. Click the arrow on the right of the item to reveal additional configuration options.
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            
                            <textarea style="display:none;"  id="nestable_list_1_output" class="form-control col-md-12 margin-bottom-10 " name="menuOrder" ></textarea>


                            <div class="dd " id="nestable_list_3">
                                <?php echo $menu; ?>
                                                          

                            </div>
                    @if ($menu)
                        <div class="form-group">
                            <div class="col-md-12">
                                @include('layouts.save_button',['title'=>'Save Menu'])      
                   
                                @include('layouts.back_button',['back'=>route('nav.index')])      
                            </div>     
                        </div>  
                     @endif
                             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('admin_content')
@section('admin_footer_scripts')
@parent 

<script src="{{ URL::asset('admin/bower_components/Nestable/jquery.nestable.js') }}"></script>

<script>
jQuery(document).ready(function() {  


 var updateOutput = function (e) {

        var list = e.length ? e : $(e.target),
            output = list.data('output');
        // console.log(list.nestable('toArray'));
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };


    // activate Nestable for list 1
            $('#nestable_list_3').nestable({
                // group: 1
            })
                .on('change', updateOutput);

             
            o = $('#nestable_list_1_output');
            updateOutput($('#nestable_list_3').data('output', o));
             
});

</script>


@endsection