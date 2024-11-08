@extends('layout.web_master')

 

@section('content')
@inject('states','App\Models\State')
<section class="wrapper bg-soft-primary">
    <div class="container pt-5   pt-md-4   text-center">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-6 col-xxl-5 mx-auto">
                <h1 class="display-1 mb-3">Contact us</h1>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                    </ol>
                </nav>
                <!-- /nav -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
<section class="wrapper ">
    <div class="container py-14 py-md-16">
        <div class="row gy-10 gx-lg-8 gx-xl-12 mb-16 align-items-center">
            <div class="col-lg-7 position-relative">
                <div class="shape bg-dot primary rellax w-18 h-18" data-rellax-speed="1" style="top: 0; left: -1.4rem; z-index: 0;"></div>
                <div class="row gx-md-5 gy-5">
                    <div class="col-md-6">
                        <figure class="rounded mt-md-10 position-relative"><img src="./assets/img/photos/g5.jpg" srcset="./assets/img/photos/g5@2x.jpg 2x" alt=""></figure>
                    </div>
                    <!--/column -->
                    <div class="col-md-6">
                        <div class="row gx-md-5 gy-5">
                            <div class="col-md-12 order-md-2">
                                <figure class="rounded"><img src="./assets/img/photos/g6.jpg" srcset="./assets/img/photos/g6@2x.jpg 2x" alt=""></figure>
                            </div>
                            <!--/column -->
                            <div class="col-md-10">
                                <div class="card bg-pale-primary text-center counter-wrapper">
                                    <div class="card-body py-11">
                                        <h3 class="counter text-nowrap">5000+</h3>
                                        <p class="mb-0">Satisfied Customers</p>
                                    </div>
                                    <!--/.card-body -->
                                </div>
                                <!--/.card -->
                            </div>
                            <!--/column -->
                        </div>
                        <!--/.row -->
                    </div>
                    <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!--/column -->
            <div class="col-lg-5">
                <h2 class="display-4 mb-8">Convinced yet? Let's make something great together.</h2>
                <div class="d-flex flex-row">
                    <div>
                        <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-location-pin-alt"></i> </div>
                    </div>
                    <div>
                        <h5 class="mb-1">Address</h5>
                        <address>Moonshine St. 14/05 Light City, <br class="d-none d-md-block" />London, United Kingdom</address>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-phone-volume"></i> </div>
                    </div>
                    <div>
                        <h5 class="mb-1">Phone</h5>
                        <p><a href="tel:00 (123) 456 78 90">00 (123) 456 78 90</a></p>
                    </div>
                </div>
                <div class="d-flex flex-row">
                    <div>
                        <div class="icon text-primary fs-28 me-6 mt-n1"> <i class="uil uil-envelope"></i> </div>
                    </div>
                    <div>
                        <h5 class="mb-1">E-mail</h5>
                        <p class="mb-0"><a href="mailto:info@mydrop.com" class="link-body">info@mydrop.com</a></p>
                    </div>
                </div>
            </div>
            <!--/column -->
        </div>
        <!--/.row -->
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-xl-8 offset-xl-2">
                <h2 class="display-4 mb-3 text-center">Drop Us a Line</h2>
                <p class="lead text-center mb-10">Reach out to us from our contact form and we will get back to you shortly.</p>
                <form class="needs-validation" method="post" action="{{ route('contactus.store') }}" novalidate>
                    <div class="messages"></div>
                    <div class="row gx-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-4">
                                <input id="form_name" type="text" name="name" class="form-control" placeholder="Jane" required>
                                <label for="form_name">First Name *</label>
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please enter your First Name. </div>
                            </div>
                        </div>
                        <!-- /column -->
                        <div class="col-md-6">
                            <div class="form-floating mb-4">
                                <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Doe" required>
                                <label for="form_lastname">Last Name *</label>
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please enter your Last Name. </div>
                            </div>
                        </div>
                        <!-- /column -->
                        <div class="col-md-12">
                            <div class="form-floating mb-4">
                                <input id="form_email" type="email" name="email" class="form-control" placeholder="jane.doe@example.com" required>
                                <label for="form_email">Email *</label>
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please provide a valid Email Address. </div>
                            </div>
                        </div>
                        <!-- /column -->
                        <input type='hidden' name='recaptcha_token' id='recaptcha_token'>
                        <!-- /column -->
                        <div class="col-12">
                            <div class="form-floating mb-4">
                                <textarea id="form_message" name="message" class="form-control" placeholder="Your message" style="height: 150px" required></textarea>
                                <label for="form_message">Message *</label>
                                <div class="valid-feedback"> Looks good! </div>
                                <div class="invalid-feedback"> Please enter your Messsage. </div>
                            </div>
                        </div>
                        {{-- Show the user the recaptcha_token error--}}
                        @if($errors->has('recaptcha_token'))
                            {{$errors->first('recaptcha_token')}}
                        @endif
                        <!-- /column -->
                        <div class="col-12 text-center">
                            <input type="submit" class="btn btn-primary rounded-pill btn-send mb-3" value="Send message">
                            <p class="text-muted"><strong>*</strong> These fields are required.</p>
                        </div>
                        <!-- /column -->
                    </div>
                    <!-- /.row -->
                </form>
                <!-- /form -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>
<!-- /section -->
@endsection
 

@section('web_footer_scripts')

<script src="https://www.google.com/recaptcha/api.js?render={{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}"></script>
<script>
grecaptcha.ready(function() {
  grecaptcha.execute('{{ env('GOOGLE_CAPTCHA_PUBLIC_KEY') }}')    .then(function(token) {
   document.getElementById("recaptcha_token").value = token;
 }); });
</script>

@endsection