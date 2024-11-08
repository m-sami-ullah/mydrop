<div class="panel" >
    <header class="panel-heading panel-border">
        Categories

        <span class="tools pull-right">
            <a class="collapse-box fa fa-chevron-{{ isset($hide) ? 'up':'down' }}" href="javascript:;"></a>
        </span>
    </header>

    <div class="panel-body" {!! isset($hide) ? 'style="display: none;"':'style="display: block;"' !!}>
        <div class="row"> 
            <div class="col-md-12">
                
                <form class="form-horizontal"   method="post" action="{{route('menu.addcategory',['nav'=>$nav->id])}}" enctype="multipart/form-data"> 
                    {{ csrf_field() }}  
                    
                    
                    
                    @foreach ($categories->get() as $category)
                    <div class="">
                        
                       <label class="">
                           <input type="checkbox" name="categories[{{ $category->id }}]" value="{{ $category->id }}"/> {{ $category->name }}
                           <input type="hidden" name="category[{{ $category->id }}][url]" value="{{ urlencode(route('category.listing',$category->slug)) }}"/>
                           <input type="hidden" name="category[{{ $category->id }}][type]" value="1"/> 
                           <input type="hidden" name="category[{{ $category->id }}][nav_id]" value="{{ $nav->id }}"/> 
                           @foreach ($category->translation as $ptrow)
                               <input type="hidden" name="category[{{ $category->id }}][title][{{ $ptrow->language_id }}]" value="{{$ptrow->name }}"/>
                           @endforeach
                        </label> 
                    </div>

                    @endforeach 
                
                @include('layouts.save_button',['title'=>'Add to Menu'])       
                </form>                            
            </div>
        </div>
    </div>
</div>