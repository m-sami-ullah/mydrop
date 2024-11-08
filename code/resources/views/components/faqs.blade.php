<!-- /section -->
<section class="wrapper bg-light">
    <div class="container py-14 py-md-16">
        <h2 class="display-4 mb-3 text-center text-primary">{{ $siteconfig->h_faq }}</h2>
        <p class="lead text-center mb-10 px-md-16 px-lg-0">{{ $siteconfig->d_faq }}</p>
        <div class="row">
            <div class="col-lg-12 mb-0">
                <div id="accordion-1" class="accordion-wrapper">
                    @foreach ($faqs as $faq)
                    
                    <div class="card">
                        <div class="card-header" id="accordion-heading-{{ $faq->id }}">
                            <button class="collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-collapse-{{ $faq->id }}" aria-expanded="false" aria-controls="accordion-collapse-{{ $faq->id }}">{{ $faq->question }}</button>
                        </div>
                        <!-- /.card-header -->
                        <div id="accordion-collapse-{{ $faq->id }}" class="collapse" aria-labelledby="accordion-heading-{{ $faq->id }}" data-bs-target="#accordion-1">
                            <div class="card-body">
                                {!! $faq->answer !!}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.collapse -->
                    </div>
                    @endforeach
                </div>
                <!-- /.accordion-wrapper -->
            </div>
             
            <!--/column -->
        </div>
        <!--/.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->