<!-- /section -->
<section id="what-we-do" class="wrapper">
    <div class="container pt-14 pt-md-16">
        <div class="row gx-lg-8 gx-xl-12 gy-10 mb-14 mb-md-17 align-items-center">
            <div class="col-lg-6 position-relative order-lg-2">
                <div class="shape bg-dot primary rellax w-16 h-20" data-rellax-speed="1" style="top: 3rem; left: 5.5rem; transform: translate3d(0, 35px, 0);"></div>
                <div class="overlap-grid overlap-grid-2">
                    <div class="item">
                        <figure class="rounded shadow"><img src="{{ $siteconfig->img1() }}" srcset="{{ $siteconfig->img1() }} 2x" alt=""></figure>
                    </div>
                    <div class="item">
                        <figure class="rounded shadow"><img src="{{ $siteconfig->img2() }}" srcset="{{ $siteconfig->img2() }} 2x" alt=""></figure>
                    </div>
                </div>
            </div>
            <!--/column -->
            <div class="col-lg-6">
                <h2 class="display-4 mb-3 text-primary">{{ $siteconfig->h_wedo }}</h2>
                <p class="lead fs-lg">{{ $siteconfig->d_wedo }}</p>

                 
                <!--/.row -->
                <div class="animated-caption mt-6" data-anim="animate__slideInUp" data-anim-delay="1500">
                	<a href="#" class="btn btn-lg btn-secondary">Read More</a>
                </div>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->


    </div>
    <!-- /.container -->
</section>