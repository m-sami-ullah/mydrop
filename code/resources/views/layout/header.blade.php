@inject("nav" , "App\Models\Menu")
@inject("services" , "App\Models\Service")
@php
    $nav4 = $nav->orderBy('sortorder','asc')->where('nav_id',1)->get();
@endphp

<header class="wrapper bg-light">
    <div class="bg-primary text-white fw-bold fs-15 mb-2">
        <div class="container py-2 d-md-flex flex-md-row">
            <div class="d-flex flex-row align-items-center me-6">
                <div class="icon text-white fs-22 mt-1 me-2"> <i class="uil uil-phone-volume"></i></div>
                <p class="mb-0">
                    <a class="text-white" href="tel:{{ $siteconfig->phone }}">{{ $siteconfig->phone }}</a></p>
            </div>
            <div class="d-flex flex-row align-items-center">
                <div class="icon text-white fs-22 mt-1 me-2"> <i class="uil uil-envelope"></i></div>
                <p class="mb-0"><a href="mailto:{{ $siteconfig->email }}" class="link-white hover">{{ $siteconfig->email }}</a></p>
            </div>
            <div class="d-flex flex-row align-items-center  me-1 ms-auto">
                @if(Auth::guard('customer')->check())
                    
                    <div class="d-flex flex-row align-items-center me-2">
                        <div class="icon text-white fs-22 mt-1 me-2"><i class="uil uil-user"></i></div>
                        <p class="mb-0"><a href="{{ route('customer.account') }}" class="link-white hover">{{ Auth::guard('customer')->user()->fullname() }}</a></p>
                    </div>

                @else
                <div class="d-flex flex-row align-items-center me-2">
                    <div class="icon text-white fs-22 mt-1 me-2"><i class="uil uil-user"></i></div>
                    <p class="mb-0"><a href="{{ route('customer.auth') }}" class="link-white hover">Login</a></p>
                </div>
                

                @endif
                <form class=" search-form">
                    <div class=" form-group form-floating mb-0 position-relative">
                        <input id="text" type="text" class="form-control" placeholder="Search">
                        <label for="text">Search</label>
                        <button type="submit" class="search-button"></button>
                    </div>
                    <!-- /.form-floating -->

                </form>
            </div>
            
        </div>
        <!-- /.container -->
    </div>
    <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
            <div class="navbar-brand w-100">
                <a href="{{ route('home') }}">
                    <img src="{{ $siteconfig->HeaderLogo() }}" srcset="{{ $siteconfig->HeaderLogo() }}" class="logo" alt="" />
                </a>
            </div>
            <div class="navbar-collapse offcanvas-nav">
                <div class="offcanvas-header d-lg-none d-xl-none">
                    <a href="{{ route('home') }}"><img src="{{ $siteconfig->HeaderLogo() }}" srcset="{{ $siteconfig->HeaderLogo() }} 2x" alt="" /></a>
                    <button type="button" class="btn-close btn-close-white offcanvas-close offcanvas-nav-close" aria-label="Close"></button>
                </div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.url',['page'=>'about-us']) }}">About Us</a>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#!">Services</a>
                        <ul class="dropdown-menu">
                            @foreach ($services->enabled()->get() as $service)
                                <li class="nav-item"><a class="dropdown-item" href="{{ route('service.url',['service'=>$service->slug]) }}">{{ $service->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">What We Do</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.contactus') }}">Contact Us</a>
                    </li>
                     
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other w-100 d-flex ms-auto">
                <ul class="navbar-nav flex-row align-items-center ms-auto" data-sm-skip="true">
                    <!-- <li class="nav-item dropdown language-select text-uppercase">
                        <a class="nav-link dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">En</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="dropdown-item" href="#">En</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="#">De</a></li>
                            <li class="nav-item"><a class="dropdown-item" href="#">Es</a></li>
                        </ul>
                            </li> -->
                    <li class="nav-item d-none d-md-block">
                        <a href="" class="btn btn-sm btn-primary rounded-pill">Order</a>
                    </li>
                    <li class="nav-item d-lg-none">
                        <div class="navbar-hamburger"><button class="hamburger animate plain" data-toggle="offcanvas-nav"><span></span></button></div>
                    </li>
                </ul>
                <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
    </nav>
    <!-- /.navbar -->
</header>
