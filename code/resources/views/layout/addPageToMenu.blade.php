<div class="panel">
    <header class="panel-heading panel-border">
        Pages

        <span class="tools pull-right">
            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
        </span>
    </header>

    <div class="panel-body">
        <div class="row"> 
            <div class="col-md-12">
                
                <form class="form-horizontal"   method="post" action="{{route('menu.addpage',['nav'=>$nav->id])}}" > 
                    {{ csrf_field() }}  
                    
                    
                    
                    @foreach ($pages->get() as $page)
                    <div class="">
                        
                       <label class="">
                           <input type="checkbox" name="pages[{{ $page->id }}]" value="{{ $page->id }}"/> {{ $page->name }}
                           <input type="hidden" name="page[{{ $page->id }}][url]" value="{{ urlencode(route('page.url',$page->slug)) }}"/>
                           <input type="hidden" name="page[{{ $page->id }}][type]" value="2"/> 
                           <input type="hidden" name="page[{{ $page->id }}][nav_id]" value="{{ $nav->id }}"/> 
                           <input type="hidden" name="page[{{ $page->id }}][title]" value="{{$page->name }}"/>
                        </label> 
                    </div>
                    @endforeach 
                
                @include('layouts.save_button',['title'=>'Add to Menu'])       
                </form>                            
            </div>
        </div>
    </div>
</div>