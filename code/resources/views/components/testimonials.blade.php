<section class="wrapper">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
            <div class="col-lg-4">

                <h3 class="display-5 mb-5 text-primary">{{ $siteconfig->h_about }}</h3>
                <p>{{ $siteconfig->d_about }}</p>
                <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="#" class="btn btn-lg btn-secondary">See All Testimonials</a></div>
            </div>
            <!--/column -->
            <div class="col-lg-8">
                <div class="carousel owl-carousel text-center" data-margin="30" data-dots="true" data-autoplay="false" data-autoplay-timeout="5000" data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "3"}}'>
                    @foreach ($testimonials as $testimonial)
                    
	                    <div class="item">
	                        <img class="rounded-circle shadow w-20 mx-auto mb-4" src="{{ $testimonial->getimage() }}" srcset="{{ $testimonial->getimage() }} 2x" alt="" />
	                        <h4 class="mb-1 text-primary">{{ $testimonial->name }}</h4>
	                        <div class="meta text-primary mb-2">{{ $testimonial->position }}</div>
	                        <p class="mb-2">{{ $testimonial->description }}</p>

	                    </div>
                    @endforeach
                </div>
                <!-- /.owl-carousel -->
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>