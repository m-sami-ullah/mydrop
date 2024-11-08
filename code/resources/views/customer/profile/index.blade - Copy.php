@extends('layout.oui_master')

@php
    $meta_title = Auth::guard('oui')->user()->name;
@endphp
@section('meta_title',$meta_title . ' | OUI Profile')

@section('profile_bread_crumb')


@section('content')
        
        <!--=====================================-->
        <!--=        Account Page Start         =-->
        <!--=====================================-->
        <section class="section-padding-equal-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 sidebar-break-sm sidebar-widget-area mt-0">
                        <div class="widget-bottom-margin widget-account-menu widget-light-bg">
                            <h3 class="widget-border-title">Menu</h3>
                            <ul class="nav nav-tabs flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#dashboard" role="tab" aria-selected="true">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#my-listing" role="tab" aria-selected="false">My Listings</a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#favourite" role="tab" aria-selected="false">Favourites</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#payment" role="tab" aria-selected="false">Payments</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#accout-detail" role="tab" aria-selected="false">Account details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                        {{ csrf_field() }}
                                    
                                        <button class=" btn" type="submit">Logout</button>
                                    </form>
                                </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                                <div class="myaccount-dashboard light-shadow-bg">
                                    <div class="light-box-content">
                                        <div class="media-box">
                                            <div class="item-img">
                                                <img src="media/figure/avatar.jpg" alt="avatar">
                                            </div>
                                            <div class="item-content">
                                                <h3 class="item-title">{{ Auth::guard('oui')->user()->name }}</h3>
                                                <div class="item-email"><span>Email: </span>{{ Auth::guard('oui')->user()->email  }}</div>
                                            </div>
                                        </div>
                                        <div class="static-report">
                                            <h3 class="report-title">Membership Report</h3>
                                            <div class="report-list">
                                                <div class="report-item">
                                                    <label>Status</label>
                                                    <div class="item-value">Active</div>
                                                </div>
                                            </div>
                                            <div class="report-list">
                                                <div class="report-item">
                                                    <label>Member since</label>
                                                    <div class="item-value">{{ Auth::guard('oui')->user()->created_at }}</div>
                                                </div>
                                            </div>
                                            <div class="report-list">
                                                <div class="report-item">
                                                    <label>Validity</label>
                                                    <div class="item-value">Until 2020-09-17 05:16:15</div>
                                                </div>
                                            </div>
                                            <div class="report-list">
                                                <div class="report-item">
                                                    <label>Remaining Ads</label>
                                                    <div class="item-value">1</div>
                                                </div>
                                            </div>
                                            <div class="report-list">
                                                <div class="report-item">
                                                    <label>Posted Ads</label>
                                                    <div class="item-value">0</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="my-listing" role="tabpanel">
                                <div class="myaccount-listing">
                                    @php
                                        /*<div class="list-view-layout1">
                                        <div class="product-box-layout3">
                                            <div class="item-img">
                                                <a href="single-product1.html"><img src="media/product/product19.jpg" alt="Product"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="item-content">
                                                    <h3 class="item-title"><a href="single-product1.html">Galaxy Note</a><span>New</span></h3>
                                                    <ul class="entry-meta">
                                                        <li><i class="far fa-clock"></i>3 months ago</li>
                                                        <li><i class="fas fa-map-marker-alt"></i>New Jersey, Cape May</li>
                                                        <li><i class="far fa-eye"></i>86 Views</li>
                                                    </ul>
                                                    <ul class="item-condition">
                                                        <li><span>Condition:</span> New</li>
                                                        <li><span>Brand:</span> Other Brand</li>
                                                    </ul>
                                                    <div class="btn-group">
                                                        <a href="#">Promote</a>
                                                        <a href="#">Edit</a>
                                                        <a href="#">Delete</a>
                                                    </div>
                                                </div>
                                                <div class="item-right">
                                                    <div class="item-price">
                                                        <span class="currency-symbol">$</span>
                                                        1,240
                                                    </div>
                                                    <div class="item-btn">
                                                        <a href="#">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>*/
                                     @endphp 
                                     <p>No Listing Found!</p>
                                </div>
                                @php
                                    /*<div class="pagination-layout1">
                                    <div class="btn-prev disabled">
                                        <a href="#"><i class="fas fa-angle-double-left"></i>Previous</a>
                                    </div>
                                    <div class="page-number">
                                        <a href="#" class="active">1</a>
                                        <a href="#">2</a>
                                    </div>
                                    <div class="btn-next">
                                        <a href="#">Next<i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>*/
                                @endphp
                            </div>
                            
                            <div class="tab-pane fade" id="favourite" role="tabpanel">
                                <div class="myaccount-listing">
                                    <p>No Favourite Listing Found!</p>
                                    @php
                                        /*<div class="list-view-layout1">
                                        <div class="product-box-layout3">
                                            <div class="item-img">
                                                <a href="single-product1.html"><img src="media/product/product19.jpg" alt="Product"></a>
                                            </div>
                                            <div class="product-info">
                                                <div class="item-content">
                                                    <h3 class="item-title"><a href="single-product1.html">Galaxy Note</a><span>New</span></h3>
                                                    <ul class="entry-meta">
                                                        <li><i class="far fa-clock"></i>3 months ago</li>
                                                        <li><i class="fas fa-map-marker-alt"></i>New Jersey, Cape May</li>
                                                        <li><i class="far fa-eye"></i>86 Views</li>
                                                    </ul>
                                                    <ul class="item-condition">
                                                        <li><span>Condition:</span> New</li>
                                                        <li><span>Brand:</span> Other Brand</li>
                                                    </ul>
                                                    <div class="btn-group">
                                                        <a href="#">Remove from Favourites</a>
                                                    </div>
                                                </div>
                                                <div class="item-right">
                                                    <div class="item-price">
                                                        <span class="currency-symbol">$</span>
                                                        1,240
                                                    </div>
                                                    <div class="item-btn">
                                                        <a href="#">Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>*/
                                    @endphp
                                     
                                </div>
                                @php
                                    /*<div class="pagination-layout1">
                                    <div class="btn-prev disabled">
                                        <a href="#"><i class="fas fa-angle-double-left"></i>Previous</a>
                                    </div>
                                    <div class="page-number">
                                        <a href="#" class="active">1</a>
                                        <a href="#">2</a>
                                    </div>
                                    <div class="btn-next">
                                        <a href="#">Next<i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>*/
                                @endphp
                            </div>
                            <div class="tab-pane fade" id="payment" role="tabpanel">
                                <div class="myaccount-payment light-shadow-bg">
                                    <div class="light-box-content">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Payment ID</th>
                                                        <th>Amount</th>
                                                        <th>Type</th>
                                                        <th>Status</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        /*<tr>
                                                        <td><a href="#">2125</a></td>
                                                        <td>
                                                            <div class="price-amount">
                                                                10
                                                                <span class="currency-symbol">$</span>
                                                            </div>
                                                        </td>
                                                        <td>Direct Bank Transfer</td>
                                                        <td>Pending</td>
                                                        <td>December 14, 2019 @ 6:49 am</td>
                                                    </tr>
                                                     */
                                                    @endphp
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    /*<div class="pagination-layout1">
                                    <div class="btn-prev disabled">
                                        <a href="#"><i class="fas fa-angle-double-left"></i>Previous</a>
                                    </div>
                                    <div class="page-number">
                                        <a href="#" class="active">1</a>
                                        <a href="#">2</a>
                                    </div>
                                    <div class="btn-next">
                                        <a href="#">Next<i class="fas fa-angle-double-right"></i></a>
                                    </div>
                                </div>*/
                                @endphp
                            </div>
                            <div class="tab-pane fade" id="accout-detail" role="tabpanel">
                                <div class="light-shadow-bg post-ad-box-layout1 myaccount-store-settings myaccount-detail">
                                    <div class="light-box-content">
                                        <form    method="post" action="" enctype="multipart/form-data">
                                            <div class="post-section basic-information">
                                                <div class="post-ad-title">
                                                    <i class="fas fa-user"></i>
                                                    <h3 class="item-title">Basic Information</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            Email
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <div class="text-value">{{ Auth::guard('oui')->user()->email  }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            Name
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <input type="text" value="Saymon" class="form-control" name="first-name" id="first-name">
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            Email
                                                            <span>*</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <input type="email" value="techlabpro.8@gmail.com" class="form-control" name="email" id="email">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            Change Password
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group mb-5">
                                                            <div class="form-check form-check-box">
                                                                <input class="form-check-input" type="checkbox" id="password" value="password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            Phone
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <input type="text" value="09988434436" class="form-control" name="phone1" id="phone1">
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                            </div>
                                            <div class="post-section location-detail">
                                                <div class="post-ad-title">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <h3 class="item-title">Location</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            State
                                                            <span>*</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <select class="form-control select-box">
                                                                <option value="0">Select State</option>
                                                                <option value="1">California</option>
                                                                <option value="2">Florida</option>
                                                                <option value="3">Hawaii</option>
                                                                <option value="4">Indiana</option>
                                                                <option value="5">Kansas</option>
                                                                <option value="6">Michigan</option>
                                                                <option value="7">New Jersey</option>
                                                                <option value="8">New Mexico</option>
                                                                <option value="9">New York</option>
                                                                <option value="10">Pennsylvania</option>
                                                                <option value="11">Texas</option>
                                                                <option value="12">Washington</option>
                                                                <option value="13">Wyoming</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            City
                                                            <span>*</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <select class="form-control select-box">
                                                                <option value="0">Select City</option>
                                                                <option value="1">Los Angeles</option>
                                                                <option value="2">LAX/LA Beaches</option>
                                                                <option value="3">San Diego</option>
                                                                <option value="4">San Jose</option>
                                                                <option value="5">San Francisco</option>
                                                                <option value="6">Fresno</option>
                                                                <option value="7">Sacramento</option>
                                                                <option value="8">Oakland</option>
                                                                <option value="9">Bakersfield</option>
                                                                <option value="10">Riverside</option>
                                                                <option value="11">Eureka</option>
                                                                <option value="12">Death Valley</option>
                                                                <option value="12">Mammoth Lakes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            Address
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <textarea name="address1" class="form-control textarea" id="address1" cols="30" rows="2">Melbourne</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    /*<div class="row">
                                                    <div class="col-sm-3">
                                                        <label class="control-label">
                                                            Map
                                                        </label>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <div id="googleMap" class="google-map" style="width: 100%; height: 400px;"></div>
                                                        </div>
                                                    </div>
                                                </div>*/
                                                @endphp
                                                <div class="row">
                                                    <div class="col-sm-3">

                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="form-group">
                                                            <input type="submit" class="submit-btn" value="Update Account">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="logout" role="tabpanel">
                                <div class="myaccount-login-form light-shadow-bg">
                                    <div class="light-box-content">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-box login-form">
                                                    <h3 class="item-title">Login</h3>
                                                    <form action="#">
                                                        <div class="form-group">
                                                            <label>Username or E-mail</label>
                                                            <input type="text" class="form-control" name="login-username" id="login-username">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Password</label>
                                                            <input type="text" class="form-control" name="login-password" id="login-password">
                                                        </div>
                                                        <div class="form-group d-flex">
                                                            <input type="submit" class="submit-btn" value="Login">
                                                            <div class="form-check form-check-box">
                                                                <input class="form-check-input" type="checkbox" id="check-password">
                                                                <label for="check-password">Remember Me</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <a href="#" class="forgot-password">Forgot your password?</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-box registration-form">
                                                    <h3 class="item-title">Register</h3>
                                                    <form action="#">
                                                        <div class="form-group">
                                                            <label>Username *</label>
                                                            <input type="text" class="form-control" name="registration-username" id="registration-username">
                                                            <div class="help-block">Username cannot be changed.</div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email address *</label>
                                                            <input type="email" class="form-control" name="registration-email" id="registration-email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Password *</label>
                                                            <input type="text" class="form-control" name="registration-password" id="registration-password">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="submit" class="submit-btn" value="Register">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection('content')







