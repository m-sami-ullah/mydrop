<section class="wrapper">
    <div class="container py-14 py-md-16">
        <div class="row gy-6">
            <div class="col-lg-4">
                <h2 class="fs-15 mt-lg-18 text-uppercase text-muted mb-3">Our Pricing</h2>
                <h2 class="display-4  mb-3 text-primary">{{ $siteconfig->h_price }}</h2>
                <p class="lead fs-lg">{{ $siteconfig->d_price }}</p>
                <div class="animated-caption mt-6" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="#" class="btn btn-lg btn-secondary">See All Pricing</a></div>
            </div>
            <!--/column -->
            <div class="col-lg-7 offset-lg-1 pricing-wrapper">
                 
                <div class="row gy-6 position-relative mt-5">
                    <div class="shape bg-dot primary rellax w-16 h-18" data-rellax-speed="1" style="bottom: -0.5rem; right: -1.6rem;"></div>
                    <div class="shape rounded-circle bg-line red rellax w-18 h-18" data-rellax-speed="1" style="top: -1rem; left: -2rem;"></div>
                    
                    @foreach ($packages as $package)
                    	<div class="col-md-6">
	                        <div class="pricing card">
	                            <div class="card-body pb-12">
	                                <div class="prices text-dark">
	                                    <div class="price price-show"><span class="price-currency">AED</span><span class="price-value">{{ $package->price }}</span> 
	                                    </div>
	                                    
	                                </div>
	                                <!--/.prices -->
	                                <h4 class="card-title mt-2">{{ $package->name }}</h4>
	                                <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
	                                	@foreach ($package->features as $feature)
	                                    	<li><i class="uil {{ $feature->availability() }}"></i><span>{{ $feature->name }}</span></li>
	                                		
	                                	@endforeach
	                                </ul>
	                                <div class="animated-caption mt-6" data-anim="animate__slideInUp" data-anim-delay="1500"><a href="{{ route('plan.url',['plan'=>$package->slug]) }}" class="btn btn-lg btn-secondary">Choose Plan</a></div>
	                            </div>
	                            <!--/.card-body -->
	                        </div>
                        <!--/.pricing -->
                    </div>
                    @endforeach
                    
                </div>
                <!--/.row -->
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>