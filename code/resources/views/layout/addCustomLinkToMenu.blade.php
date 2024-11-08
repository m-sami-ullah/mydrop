<div class="panel" >
    <header class="panel-heading panel-border">
        Custom link

        <span class="tools pull-right">
            <a class="collapse-box fa fa-chevron-{{ isset($hide) ? 'up':'down' }}" href="javascript:;"></a>
        </span>
    </header>

    <div class="panel-body" {!! isset($hide) ? 'style="display: none;"':'style="display: block;"' !!}>
                
                <form class="form-horizontal"   method="post" action="{{route('menu.addcustom',['nav'=>$nav->id])}}" > 
                    {{ csrf_field() }}  
                    
                    
        <div class="row"> 
            <div class="col-md-12">
                    
                    <label for="" class="control-label">URL / Link</label>

                    <input   name="url" value="" required="" class="form-control" placeholder="URL" type="url">
                    <input type="hidden" name="type" value="3"/>
                    </label>
                    <div class="">

                        <label for="" class="control-label">Label</label>

                            <input required=""  name="title" value=""  class="form-control" placeholder="" type="text">

                        </div>    

                    <br/>
                    @include('layouts.save_button',['title'=>'Add to Menu'])       
            </div>
        </div>
                </form>                            
    </div>
</div>