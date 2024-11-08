@inject("nav" , "App\Models\Nav")
@php
    $nav1 = $nav->with(['menus'=>function($q)
            {
                $q->orderBy('sortorder','asc');
            }])->find(2);

    $nav2 = $nav->with(['menus'=>function($q)
            {
                $q->orderBy('sortorder','asc');
            }])->find(3);
    $nav3 = $nav->with(['menus'=>function($q)
            {
                $q->orderBy('sortorder','asc');
            }])->find(4);

@endphp

<footer class="bg-light">
        <div class="container pb-0 pt-13 pt-md-15">
            <div class="row gy-6 gy-lg-0">
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <img class="mb-4 logo" src="{{ $siteconfig->Footer_Logo() }}" srcset="{{ $siteconfig->Footer_Logo() }}" alt="" />
                        <p>{{ $siteconfig->disclaimer }}</p>
                        <p class="mb-4">© 2021 <span class="text-secondary">My Drop</span>. All rights reserved.</p>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title  mb-3">Useful Links</h4>
                        <ul class="list-unstyled text-reset mb-0">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">What We Do?</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <!-- /.widget -->
                </div>
                <div class="col-md-4 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title  mb-3">Get in Touch</h4>
                        <address class="pe-xl-15 pe-xxl-17">Moonshine St. 14/05 Light City, London, United Kingdom</address>
                        <a href="mailto:{{ $siteconfig->email }}" class="link-body">{{ $siteconfig->email }}</a><br />
                        <a href="tel:{{ $siteconfig->phone }}">{{ $siteconfig->phone }}</a>
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->

                <!-- /column -->
                <div class="col-md-12 col-lg-3">
                    <div class="widget">
                        <h4 class="widget-title  mb-3">Our Newsletter</h4>
                        <p class="mb-5">Subscribe to our newsletter to get our news & deals delivered to you.</p>
                        <div class="newsletter-wrapper">
                            <!-- Begin Mailchimp Signup Form -->
                            <div id="mc_embed_signup2">
                                <form action="" method="post" id="mc-embedded-subscribe-form2" name="mc-embedded-subscribe-form" class="validate " target="_blank" novalidate>
                                    <div id="mc_embed_signup_scroll2">
                                        <div class="mc-field-group input-group form-floating">
                                            <input type="email" value="" name="EMAIL" class="required email form-control" placeholder="Email Address" id="mce-EMAIL2">
                                            <label for="mce-EMAIL2">Email Address</label>
                                            <input type="submit" value="Join" name="subscribe" id="mc-embedded-subscribe2" class="btn btn-primary">
                                        </div>
                                        <div id="mce-responses2" class="clear">
                                            <div class="response" id="mce-error-response2" style="display:none"></div>
                                            <div class="response" id="mce-success-response2" style="display:none"></div>
                                        </div>
                                        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc" tabindex="-1" value=""></div>
                                        <div class="clear"></div>
                                    </div>
                                </form>
                            </div>
                            <nav class="nav social mt-6">
                                @php
                                    $socials = \App\Models\Social::enable()->get();
                                @endphp
                                @foreach ($socials as $social)
                                <a href="{!! $social->link !!}"><i class="uil uil-{{ $social->icon }}"></i></a>
                                @endforeach
                                
                            

                            </nav>
                            <!-- /.social -->
                            <!--End mc_embed_signup-->
                        </div>
                        <!-- /.newsletter-wrapper -->
                    </div>
                    <!-- /.widget -->
                </div>
                <!-- /column -->
            </div>
            <hr class="my-2 p-0 text-secondary">
            <div class="d-flex justify-content-between mb-2 align-items-center">
                <div class="">Designed and Developed by <a href="#" target="_blank" class="text-secondary">Solutionica</a> </div>
                <div class="">
                    <img class="img-fluid payment" src="./assets/img/payment.png" alt="">

                </div>
            </div>
            <!--/.row -->
        </div>
        <!-- /.container -->
    </footer>
      
 