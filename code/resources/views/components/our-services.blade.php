<!-- /section -->
<section class="wrapper">
    <div class="container pt-14 pt-md-16 pb-6 pb-md-8">
        <h2 class="display-4 mb-3 text-center text-primary">Our Services</h2>

        <div class="carousel owl-carousel blog grid-view" data-margin="30" data-dots="true" data-autoplay="false" data-autoplay-timeout="5000" data-responsive='{"0":{"items": "1"}, "768":{"items": "2"}, "992":{"items": "2"}, "1200":{"items": "3"}}'>
            
        	@foreach ($services as $service)
        	
	            <div class="item">
	                <div class="card shadow">
	                    <img src="{{ $service->getimage() }}" class="card-img-top" alt="{{ $service->title }}">
	                    <div class="card-body p-4 text-center">
	                        <h3 class="card-title text-primary">{{ $service->title }}</h3>
	                        <p class="card-text">{{ $service->short }}</p>
	                        <div class="animated-caption" data-anim="animate__slideInUp" data-anim-delay="1500">
	                        	<a href="{{ route('service.url',['service'=>$service->slug]) }}" class="btn btn-lg btn-secondary">Read More</a>
	                        </div>
	                    </div>
	                </div>
	                <!-- /article -->
	            </div>
            @endforeach
        </div>
        <!-- /.owl-carousel -->
    </div>
    <!-- /.container -->
</section>