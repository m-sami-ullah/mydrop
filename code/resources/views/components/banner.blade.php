@props(['banners'])
 <section class="wrapper upper-end lower-end">
            <div class="container-fluid px-0">
                <div id="home-slider" class="hero-slider-wrapper bg-dark">
                    <div class="hero-slider owl-carousel dots-over" data-nav="false" data-dots="true" data-autoplay="true">

                    	@foreach ($banners as $banner)
	                        <div class="owl-slide d-flex align-items-center bg-overlay bg-overlay-400" style="background-image: url('{{ $banner->getimage() }}');">
	                            <div class="container light-gallery-wrapper">
	                                <div class="row">
	                                    <div class="col-md-11 col-lg-8 col-xl-7 col-xxl-6 mx-auto text-center">
	                                        <h2 class="display-1 fs-56 mb-4 text-secondary animated-caption" data-anim="animate__slideInDown" data-anim-delay="500">{{ $banner->name }}</h2>
	                                        <p class="lead fs-23 lh-sm mb-7 text-white animated-caption" data-anim="animate__slideInRight" data-anim-delay="1000">{{ $banner->description }}</p>
	                                        @if (!empty ($banner->btntitle))
		                                        <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500">
		                                        	<a href="{{ $banner->link }}" class="btn btn-lg btn-secondary">{{ $banner->btntitle }}</a>
		                                        </div>
	                                        @endif

	                                    </div>
	                                    <!--/column -->
	                                </div>
	                                <!--/.row -->
	                            </div>
	                            <!--/.container -->
	                        </div>
                    	@endforeach
                         
                        <!--/.owl-slide -->

                    </div>
                    <!--/.hero-slider -->
                </div>
                <!--/.hero-slider-wrapper -->

                <div class="row">
                    <div class="col-12">
                        <div class="row" data-cue="slideInUp" data-show="true" style="animation-name: slideInUp; animation-duration: 700ms; animation-timing-function: ease; animation-delay: 0ms; animation-direction: normal; animation-fill-mode: both;">
                            <div class="col-xl-10 mx-auto">
                                <div class="card image-wrapper bg-full bg-image bg-overlay bg-overlay-300 text-white mt-n5 mt-lg-0 mt-lg-n50p mb-lg-n50p border-radius-lg-top" data-image-src="./assets/img/photos/bg2.jpg" style="background-image: url(&quot;./assets/img/photos/bg2.jpg&quot;);">
                                    <div class="card-body p-9 p-xl-10">
                                        <div class="row align-items-center counter-wrapper gy-4 text-left">
                                            <div class="col-6 col-lg-3">
                                                <div class="d-flex flex-row">
                                                    <div>
                                                        <div id="feature-box" class="icon me-1"><i class="uil uil-comments"></i></div>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-white mb-0">24/7 Support</h4>
                                                        <p class="mb-2">Nulla vitae elit libero, a pharetra augue. </p>
                                                    </div>
                                                </div>

                                            </div>
                                            <!--/column -->
                                            <div class="col-6 col-lg-3">
                                                <div class="d-flex flex-row">
                                                    <div>
                                                        <div id="feature-box" class="icon me-1"><i class="uil uil-shield"></i></div>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-white mb-0">Secure Payment</h4>
                                                        <p class="mb-2">Nulla vitae elit libero, a pharetra augue. </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/column -->
                                            <div class="col-6 col-lg-3">
                                                <div class="d-flex flex-row">
                                                    <div>
                                                        <div id="feature-box" class="icon me-1"><i class="uil uil-calendar-alt"></i></div>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-white mb-0">Daily Updates</h4>
                                                        <p class="mb-2">Nulla vitae elit libero, a pharetra augue. </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/column -->
                                            <div class="col-6 col-lg-3">
                                                <div class="d-flex flex-row">
                                                    <div>
                                                        <div id="feature-box" class="icon me-1"><i class="uil uil-chart-line"></i></div>
                                                    </div>
                                                    <div>
                                                        <h4 class="text-white mb-0">Market Research</h4>
                                                        <p class="mb-2">Nulla vitae elit libero, a pharetra augue. </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/column -->
                                        </div>
                                        <!--/.row -->
                                    </div>
                                    <!--/.card-body -->
                                </div>
                                <!--/.card -->
                            </div>
                            <!-- /column -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /column -->
                </div>
            </div>
        </section>