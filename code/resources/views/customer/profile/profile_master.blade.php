@extends('layout.web_master')

@php
	$meta_title = Auth::guard('customer')->user()->fullname();
@endphp
 

@section('meta_title',$meta_title)


@section('profile_bread_crumb')
<li>{{ trans('lang.my_account') }}</li>
@endsection

@section('content')
@include('customer.profile.banner')
	<section class="wrapper ">
            <div class="container py-14 py-md-16">
                <div class="row gx-lg-8 gx-xl-12">
                    <div class="col-lg-8 order-1 order-lg-2  ">
                      @include('customer.errors')
                       @yield('profile_content')
                        <!-- /nav -->
                    </div>
					<aside class="col-lg-4 sidebar mt-4 mt-md-0">
				        <!-- /.widget -->
				        <div class="widget">
				            <h3 class="widget-title mb-3">My Account</h3>
				            <ul class="nav nav-tabs nav-tabs-bg d-flex justify-content-between nav-justified flex-lg-column flex-column">
				                <li class="nav-item mx-0 ">
				                    <a class="nav-link d-flex flex-row {{ request()->routeIs('customer.account') ? 'active':'' }} p-2" href="{{ route('customer.account') }}">
				                        <div><i class="uil uil-user"></i></div>
				                        <div>
				                            <h4 class="ms-2 m-0">Profile</h4>

				                        </div>
				                    </a>
				                </li>
				                <li class="nav-item mx-0">
				                    <a class="nav-link d-flex flex-row  p-2 {{ request()->routeIs('customer.addresses') ? 'active':'' }}" href="{{ route('customer.addresses') }}">
				                        <div><i class="uil uil-location"></i></div>
				                        <div>
				                            <h4 class="ms-2 m-0">Address</h4>

				                        </div>
				                    </a>
				                </li>
				                <li class="nav-item mx-0">
				                    <a class="nav-link d-flex flex-row p-2  {{ request()->routeIs('customer.boxes.*') ? 'active':'' }}" href="{{ route('customer.boxes.index') }}">
				                        <div><i class="uil uil-parcel"></i></div>
				                        <div>
				                            <h4 class="ms-2 m-0">Boxes</h4>

				                        </div>
				                    </a>
				                </li>
				                <li class="nav-item mx-0">
				                    <a class="nav-link d-flex flex-row p-2  {{ request()->routeIs('customer.orders') ? 'active':'' }}" href="{{ route('customer.orders') }}">
				                        <div><i class="uil uil-parcel"></i></div>
				                        <div>
				                            <h4 class="ms-2 m-0">My Orders</h4>

				                        </div>
				                    </a>
				                </li>
				             
				                <li class="nav-item mx-0">
				                    <a class="nav-link d-flex flex-row p-2  {{ request()->routeIs('customer.changepassword') ? 'active':'' }}" href="{{ route('customer.changepassword') }}">
				                        <div><i class="uil uil-lock"></i></div>
				                        <div>
				                            <h4 class="ms-2 m-0">Change Password</h4>

				                        </div>
				                    </a>
				                </li>
				                <li class="nav-item mx-0">
				                    <a class="nav-link d-flex flex-row p-2" href="#tab2-1">
				                        <div><i class="uil uil-user"></i></div>
				                        <div>
			                        	<form id="logout-form" action="{{ route('logout') }}" method="POST" >
			                                    	{{ csrf_field() }}
	                                    
	                                    	<button class=" btn-white btn btn-link" type="submit"><h4 class="ms-2 m-0">Logout</h4></button>
	                                	</form>
				                            

				                        </div>
				                    </a>
				                </li>
				            </ul>

				        </div>
				        <!-- /.widget -->
				    </aside>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </section>	
	<!-- /column -->
   
   
@endsection('content')







