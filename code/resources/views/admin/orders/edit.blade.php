@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Orders
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("orders.index") }}" >Orders</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')
<div class="row">

    <div class="col-md-12">
        <div class="panel">
            <header class="panel-heading panel-border">
                ORDER #{{ $order->id }} - {{ $order->orderdate() }}
                 
            </header>
            <div class="panel-body">
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1"data-toggle="tab">Order Details</a></li>
                        <li class=""><a href="#tab3"data-toggle="tab">Customer Details</a></li>
                    </ul>
                    <div class="tab-content panel wrapper">
                        <div id="tab1" class="tab-pane fade active in">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Order information</h2>
                                    <hr/>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-4">Order Number:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->id }}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Date:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->orderdate() }}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Customer Name:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong><a href="#">{{ $order->customername() }}</a></strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Total Amount:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->totalpaid() }}</strong>
                                            </div>
                                        </div>
                                          
                                        
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h2>&nbsp;</h2>
                                    <hr/>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Payment Method:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->payment_type }}</strong>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Package:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->package }}</strong>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Device Address:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->complete_address() }}</strong>
                                            </div>
                                        </div>

                                         

                                    </form>
                                </div>
                            </div>
                        </div>
                         
                        <div id="tab3" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Customer information</h2>
                                    <hr/>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-4">Customer Name:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->customer->fullname() }}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Address:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>{{ $order->customer->saddress }}</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">City:
                                            </div>
                                            <div class="col-sm-8">
                                                {{-- <strong> {{ $order->customer->addresses->getcity() }}</strong> --}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Country:
                                            </div>
                                            <div class="col-sm-8">
                                                {{-- <strong>{{ $order->customer->getcountry() }}</strong> --}}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Phone Number:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>012345678</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Email:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>test@test.com</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">Previous Order:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>Nill</strong>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h2>Billing information</h2>
                                    <hr/>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Payment Method:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>Credit Card</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Billing method:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>Plane</strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Billing Address:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>123 Australia, Melborne</strong>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Items:
                                            </div>
                                            <div class="col-sm-8 ">
                                                <strong> 3 Item </strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Client:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>2 past orders </strong>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-4">
                                                Other info:
                                            </div>
                                            <div class="col-sm-8">
                                                <strong>some other information goes here</strong>
                                            </div>
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

@endsection('admin_content')

@section('more_scripts')
@parent
<!-- Select2 Dependencies -->
<link rel="stylesheet" href="{{ URL::asset('admin/bower_components/select2/dist/css/select2.min.css') }}">
<!-- Select2 Dependencies -->
<script src="{{ URL::asset('admin/bower_components/select2/dist/js/select2.min.js') }}"></script>

<script src="{{ URL::asset('admin/bower_components/summernote/dist/summernote.js') }}"></script>
  <script>
(function($) {

    'use strict';
    
    $(".select2").select2({
        placeholder: "Select"
    });

    $('.summernote').summernote({
        height: 300,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote

    });
    
})(window.jQuery);  
</script>
@endsection

