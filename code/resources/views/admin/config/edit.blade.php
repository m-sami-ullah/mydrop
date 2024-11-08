@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Home
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')

    @include('layouts.hometabs')

<form class="form-horizontal"   method="post" action="{{route('config.update', ['config'=>$config->id])}}" enctype="multipart/form-data">

<div class="row">
<div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                @include('layouts.save_button')
            </header>

            <div class="panel-body">
                <div class="row">

 
                   
                    <div class="col-md-12">
                    
                        
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                    
                    <h4>Trusted Clients</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            @include('layouts.input',['title'=>'Heading','name'=>'h_trusted','value'=>$config->h_trusted])
                        </div>

                        <div class="col-lg-12">
                            @include('layouts.input',['type'=>'textarea','title'=>'Short Description','name'=>'d_trusted','value'=>$config->d_trusted])
                        </div>
                    </div>
                    <hr>

                    <h4>What we do</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            @include('layouts.input',['title'=>'Heading','name'=>'h_wedo','value'=>$config->h_wedo])
                        </div>

                        <div class="col-lg-12">
                            @include('layouts.input',['type'=>'textarea','title'=>'Short Description','name'=>'d_wedo','value'=>$config->d_wedo])
                        </div>
                        <div class="col-lg-6">
                            @include('layouts.input',['title'=>'First Image','name'=>'img1_wedo','type'=>'file','value'=>$config->img1()])    
                        </div>
                        
                        <div class="col-lg-6">
                            @include('layouts.input',['title'=>'Second Image','name'=>'img2_wedo','type'=>'file','value'=>$config->img2()])    
                        </div>
                    </div>
                    <hr>


                    <h4>Our Solutions</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            @include('layouts.input',['title'=>'Heading','name'=>'h_sol','value'=>$config->h_sol])
                        </div>

                        <div class="col-lg-12">
                            @include('layouts.input',['type'=>'textarea','title'=>'Short Description','name'=>'d_sol','value'=>$config->d_sol])
                        </div>
                        <div class="col-lg-12">
                            @include('layouts.input',['title'=>'Image','name'=>'img_sol','type'=>'file','value'=>$config->img3()])    
                        </div>
                        
                         
                    </div>
                    <hr>

                    <h4>Our Pricing</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            @include('layouts.input',['title'=>'Heading','name'=>'h_price','value'=>$config->h_price])
                        </div>

                        <div class="col-lg-12">
                            @include('layouts.input',['type'=>'textarea','title'=>'Short Description','name'=>'d_price','value'=>$config->d_price])
                        </div>
                         
                         
                    </div>
                    <hr>

                    <h4>FAQ</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            @include('layouts.input',['title'=>'Heading','name'=>'h_faq','value'=>$config->h_faq])
                        </div>

                        <div class="col-lg-12">
                            @include('layouts.input',['type'=>'textarea','title'=>'Short Description','name'=>'d_faq','value'=>$config->d_faq])
                        </div>
                         
                         
                    </div>
                    <hr>

                    <h4>Testimonials</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            @include('layouts.input',['title'=>'Heading','name'=>'h_about','value'=>$config->h_about])
                        </div>

                        <div class="col-lg-12">
                            @include('layouts.input',['type'=>'textarea','title'=>'Short Description','name'=>'d_about','value'=>$config->d_about])
                        </div>
                         
                         
                    </div>
                    <hr>


                    <h4>Site</h4>
                   
                    <div class="row">
                        <div class="col-lg-6">
                        @include('layouts.input',['title'=>'Phone','name'=>'phone','value'=>$config->phone])
                        </div>

                        <div class="col-lg-6">
                        @include('layouts.input',['title'=>'Email','name'=>'email','value'=>$config->email])
                        </div>
                    <div class="col-lg-12">
                        @include('layouts.input',['title'=>'Site Disclaimer','name'=>'disclaimer','type'=>'textarea','value'=>$config->disclaimer])
                    </div>

                    </div>
                    

                    <div class="col-lg-6">
                            @include('layouts.input',['title'=>'Logo','name'=>'image','type'=>'file','value'=>$config->HeaderLogo()])    
                    </div>
                    
                    <div class="col-lg-6">
                        @include('layouts.input',['title'=>'Footer Logo','name'=>'footerlogo','type'=>'file','value'=>$config->Footer_Logo()])    
                    </div>
                    
                    <div class="col-lg-6">
                        @include('layouts.input',['title'=>'Fav Icon','name'=>'favicon','type'=>'file','value'=>$config->FaviIcon()])    
                    </div>
                    
                        @include('layouts.seo',['mt'=>$config->meta_title,'mk'=>$config->keywords,'md'=>$config->meta_description,'mr'=>$config->robots])
                    
                                    

                    {{-- @include('layouts.input',['title'=>'Notification Phone','name'=>'notify','value'=>$config->notify]) --}}
                            
                            
                            {{-- @include('layouts.input',['title'=>'Watermark','name'=>'watermark','type'=>'file','value'=>$config->water_mark()])     --}}
                            
                            

                           
                        
                              
                              
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>     
</form>
@endsection('admin_content')
