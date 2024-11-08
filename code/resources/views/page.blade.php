@extends('layout.web_master')

@section('meta_seo')

<meta name="title" content="{{$page->meta_title}}">
<meta name="description" content="{{$page->meta_description}}">
<meta name="keywords" content="{{$page->keywords}}">
<meta name="robots" content="{{$page->robots}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta property="og:url"           content="{{url()->current()}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$page->meta_title}}" />
<meta property="og:description"   content="{{$page->meta_description}}" />
<meta property="og:image"         content="{{ $page->getimage() }}" />

<meta name="twitter:title" content="{{$page->meta_title}}">
<meta name="twitter:description" content="{{$page->meta_description}}">
<meta name="twitter:image" content="{{ $page->getimage() }}">
<meta name="twitter:card" content="mydropbykagtec">
<link rel="canonical" href="{{url()->current()}}">
<meta property="fb:app_id" content="" /> 
<meta property="og:site_name" content="mydrop.ae" />

 
@endsection

@section('content')
 <section class="wrapper image-wrapper bg-image bg-overlay text-white" @if (!empty($page->image))  data-image-src="{{ $page->getimage() }}" @endif>
      <div class="container pt-17 pb-12 pt-md-19 pb-md-16 text-center">
        <div class="row">
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <div class="post-header">
              <!-- /.post-category -->
              <h1 class="display-1 mb-3 text-white">{{ $page->name }}</h1>
              <p class="lead px-md-12 px-lg-12 px-xl-15 px-xxl-18">{{ $page->short_description }}</p>
            </div>
            <!-- /.post-header -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper  wrapper-border">
      <div class="container pt-14 pt-md-16 pb-13 pb-md-15">
        <div class="row">
          <div class="col-lg-10 offset-lg-1">
            <article>
              <h2 class="display-6 mb-4">{{ $page->name }}</h2>
              <div class="row gx-0">
                <div class="col text-justify">
                 {!! $page->description !!}
                </div>
                
              </div>
              <!--/.row -->
            </article>
            <!-- /.project -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
    
    </section>
    <!-- /section -->
@endsection