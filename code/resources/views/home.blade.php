@extends('layout.web_master')

@section('meta_seo')

<meta name="title" content="{{$siteconfig->meta_title}}">
<meta name="description" content="{{$siteconfig->meta_description}}">
<meta name="keywords" content="{{$siteconfig->keywords}}">
<meta name="robots" content="{{$siteconfig->robots}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta property="og:url"           content="{{url()->current()}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$siteconfig->meta_title}}" />
<meta property="og:description"   content="{{$siteconfig->meta_description}}" />
<meta property="og:image"         content="{{ $siteconfig->HeaderLogo() }}" />

<meta name="twitter:title" content="{{$siteconfig->meta_title}}">
<meta name="twitter:description" content="{{$siteconfig->meta_description}}">
<meta name="twitter:image" content="{{ $siteconfig->HeaderLogo() }}">
<meta name="twitter:card" content="mydropbykagtec">
<link rel="canonical" href="{{url()->current()}}">
<meta property="fb:app_id" content="" /> 
<meta property="og:site_name" content="mydrop.ae" />

 
@endsection

@section('meta_title','MyDrop')

@section('content')
<div class="content-wrapper">    

    <x-banner :banners="$banners" />
    <x-trusted-clients :clients="$clients"  />
    <x-our-services :services="$services"  />
    <x-what-we-do  />

        
    
    
    <section class="wrapper bg-light angled lower-end">
        <div class="container py-6 py-md-10">
            <div class="row gx-lg-0 gx-xl-8 gy-10 gy-md-13 gy-lg-0 mb-7 mb-md-10 mb-lg-16 align-items-center">
                <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-1 position-relative " data-cue="zoomIn">
                    <div class="shape bg-dot primary rellax w-17 h-19" data-rellax-speed="1" style="top: -1.7rem; left: -1.5rem;"></div>
                    <div class="shape rounded bg-soft-primary rellax d-md-block" data-rellax-speed="0" style="bottom: -1.8rem; right: -0.8rem; width: 85%; height: 90%;"></div>
                    <figure class="rounded"><img src="{{ $siteconfig->img3() }}" srcset="{{ $siteconfig->img3() }} 2x" alt="" /></figure>
                </div>
                <!--/column -->
                <div class="col-lg-5 mt-lg-n10 text-center text-lg-start" data-cues="slideInDown" data-group="page-title" data-delay="600">
                    <h2 class="fs-15 text-uppercase text-muted mb-3">Our Solutions</h2>
                    <h1 class="display-1 mb-5 text-primary">{{ $siteconfig->h_sol }}</h1>
                    <p class="lead fs-25 lh-sm mb-7 px-md-10 px-lg-0">{{ $siteconfig->d_sol }}</p>
                    <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="#" class="btn btn-lg btn-secondary">Read More</a></div>
                </div>
                <!--/column -->
            </div>
        </div>
    </section>
        
    <x-prices :packages="$packages" />
    
    <x-faqs :faqs="$faqs" />

    <x-testimonials :testimonials="$testimonials" />

        
        <!-- /section -->
</div>
@endsection


@section('web_footer_scripts')
 
<script type="text/javascript">

     
</script>

@endsection