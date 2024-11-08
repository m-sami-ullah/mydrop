<section class="wrapper bg-light angled upper-end lower-end">
    <div class="container py-14 py-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 gy-lg-0 align-items-center">
            <div class="col-lg-6 mt-lg-2">
                <h3 class="display-4 mb-3 text-primary pe-xxl-5">{{ $siteconfig->h_trusted }}</h3>
                <p class="lead fs-lg mb-0 pe-xxl-5">{{ $siteconfig->d_trusted }}</p>
            </div>
            <!-- /column -->
            <div class="col-lg-6">
                <div class="carousel owl-carousel" data-nav="false" data-dots="true" data-autoplay="true" data-autoplay-timeout="5000" data-responsive='{"0":{"items": "1"}, "768":{"items": "1"}, "992":{"items": "1"}, "1200":{"items": "1"}}'>
                    <div class="item">
                        <div class="row row-cols-2 row-cols-md-3 gx-0 gx-md-8 gx-xl-12 gy-12">

                        	@foreach ($clients as $client)

	                            <div class="col">
	                                <figure class="px-3 px-md-0 px-xxl-2"><img src="{{ $client->getlogo() }}" alt="{{ $client->name }}" /></figure>
	                            </div>
                        	@endforeach
                            
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <div class="row row-cols-2 row-cols-md-3 gx-0 gx-md-8 gx-xl-12 gy-12">

                            @foreach ($clients as $client)

	                            <div class="col">
	                                <figure class="px-3 px-md-0 px-xxl-2"><img src="{{ $client->getlogo() }}" alt="{{ $client->name }}" /></figure>
	                            </div>
                        	@endforeach
                            
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.item -->
                    <div class="item">
                        <div class="row row-cols-2 row-cols-md-3 gx-0 gx-md-8 gx-xl-12 gy-12">

                           @foreach ($clients as $client)

	                            <div class="col">
	                                <figure class="px-3 px-md-0 px-xxl-2"><img src="{{ $client->getlogo() }}" alt="{{ $client->name }}" /></figure>
	                            </div>
                        	@endforeach
                            
                        </div>
                        <!--/.row -->
                    </div>
                    <!-- /.item -->

                </div>
                <!-- /.owl-carousel -->
                <div class="owl-dots"></div>
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>