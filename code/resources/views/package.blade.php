@extends('layout.web_master')

@section('meta_seo')

<meta name="title" content="{{$plan->meta_title}}">
<meta name="description" content="{{$plan->meta_description}}">
<meta name="keywords" content="{{$plan->keywords}}">
<meta name="robots" content="{{$plan->robots}}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta property="og:url"           content="{{url()->current()}}" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="{{$plan->meta_title}}" />
<meta property="og:description"   content="{{$plan->meta_description}}" />
{{-- <meta property="og:image"         content="{{ $plan->getimage() }}" /> --}}

<meta name="twitter:title" content="{{$plan->meta_title}}">
<meta name="twitter:description" content="{{$plan->meta_description}}">
{{-- <meta name="twitter:image" content="{{ $plan->getimage() }}"> --}}
<meta name="twitter:card" content="mydropbykagtec">
<link rel="canonical" href="{{url()->current()}}">
<meta property="fb:app_id" content="" /> 
<meta property="og:site_name" content="mydrop.ae" />

 
@endsection

@section('content')
 <section class="wrapper image-wrapper bg-image bg-overlay text-white">
      <div class="container pt-17 pb-12 pt-md-19 pb-md-16 text-center">
        <div class="row">
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <div class="post-header">
              <!-- /.post-category -->
              <h1 class="display-1 mb-3 text-white">{{ $plan->name }}</h1>
              <p class="lead px-md-12 px-lg-12 px-xl-15 px-xxl-18">{{ $plan->short }}</p>
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
          <div class="col-lg-12 pricing-wrapper">
            <article>
              <h2 class="display-6 mb-4">{{ $plan->name }}</h2>
              <div class="row gx-0">
                <div class="col-md-8 text-justify">
                 {!! $plan->description !!}
                </div>
                <div class="col-md-4 ms-auto pricing-wrapper">
                  @if ($plan->features->count())
                  <div class="pricing card ">
                        <div class="card-body pb-12">
                            <div class="prices text-dark">
                                <div class="price price-show"><span class="price-currency">AED</span><span class="price-value">{{ $plan->price }}</span> 
                                </div>
                                
                            </div>
                            <!--/.prices -->
                            <h4 class="card-title mt-2">{{ $plan->name }}</h4>
                            <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                              @foreach ($plan->features as $feature)
                                  <li><i class="uil {{ $feature->availability() }}"></i><span>{{ $feature->name }}</span></li>
                                
                              @endforeach
                            </ul>
                            <div class="animated-caption mt-6" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="{{ route('plan.url',['plan'=>$plan->slug]) }}" class="btn btn-lg btn-secondary">Choose Plan</a></div>
                        </div>
                        <!--/.card-body -->
                    </div>
                  

                   
                  @endif
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