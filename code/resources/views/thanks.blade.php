@extends('layout.web_master')

 

@section('content')
@inject('states','App\Models\State')
<section class="wrapper bg-soft-primary">
    <div class="container pt-5   pt-md-4   text-center">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-6 col-xxl-5 mx-auto">
                <h1 class="display-1 mb-3">Thank you</h1>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thank you</li>
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
    <section class="wrapper  wrapper-border">
      <div class="container pb-13 pb-md-15">
         <p class="mt-4">
            Dear <b>{{ Auth::guard('customer')->user()->fullname() }}</b>,<br>
            We have received your order, One of our sales staff will contact you soon.
            <br>
            <br>
            Team MyDropMox
         </p>
        <!-- /.row -->
      </div>
    
    </section>
    <!-- /section -->
@endsection