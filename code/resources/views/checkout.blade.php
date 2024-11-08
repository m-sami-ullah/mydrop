@extends('layout.web_master')

 

@section('content')
@inject('states','App\Models\State')
<section class="wrapper bg-soft-primary">
    <div class="container pt-5   pt-md-4   text-center">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-6 col-xxl-5 mx-auto">
                <h1 class="display-1 mb-3">Checkout</h1>
                <nav class="d-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
  <form class="form-horizontal"   method="post" action="{{route('payment',['plan'=>$plan->slug])}}" > 
    @csrf
    <section class="wrapper  wrapper-border">
      <div class="container pb-13 pb-md-15">
        <div class="row">
          <div class="col-lg-12 pricing-wrapper">
            <div class="container">

            <div class="row my-10">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                    </h4>
                    <article>
                      <div class="row gx-0">
                        <div class="col-md-8 text-justify">
                         {!! $plan->description !!}
                        </div>
                        <div class="  ms-auto pricing-wrapper">
                          @if ($plan->features->count())
                          <div class="pricing card ">
                                <div class="card-body pb-12">
                                    <div class="prices text-dark">
                                        <div class="price price-show"><span class="price-currency">AED</span><span class="price-value">{{ $plan->price }}</span> 
                                        </div>
                                        
                                    </div>
                                    <!--/.prices -->
                                    <h4 class="card-title mt-2">{{ $plan->name }}</h4>
                                    <ul class="icon-list bullet-bg bullet-soft-primary mt-8 mb-9">
                                      @foreach ($plan->features as $feature)
                                          <li><i class="uil {{ $feature->availability() }}"></i><span>{{ $feature->name }}</span></li>
                                        
                                      @endforeach
                                    </ul>
                                </div>
                                <!--/.card-body -->
                            </div>
                          

                           
                          @endif
                        </div>
                      </div>
                      <!--/.row -->
                    </article>
                   


                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    <form class="needs-validation">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input  required="required"  value="{{ Auth::guard('customer')->user()->firstname }}"  name="firstname" placeholder="First name" class="form-control">
                                    <label for="firstName">First name</label>
                                </div>
                                @if($errors->has('firstname'))
                                    <small class="form-text text-danger">{{ $errors->first('firstname') }}</small> 
                                @endif
                               
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input required="required"  value="{{ Auth::guard('customer')->user()->lastname }}" class="form-control" name="lastname" class="form-control" placeholder="Last Name">
                                    <label for="lastName">Last name</label>
                                </div>
                                  @if($errors->has('lastname'))
                                    <small class="form-text text-danger">{{ $errors->first('lastname') }}</small> 
                                @endif
                            </div>
 
                            <div class="col-12">
                                <div class="form-floating mb-4">
                                    <input name="email" type="email" value="{{ Auth::guard('customer')->user()->email }}" placeholder="Email" class="form-control">
                                    <label for="email">Email</label>
                                </div>
                                @if($errors->has('email'))
                                    <small class="form-text text-danger">{{ $errors->first('email') }}</small> 
                                @endif
                            </div>

                            <div class="col-12">
                                <div class="form-floating mb-4">
                                    <textarea id="address" name="address" class="form-control" placeholder="Address" style="height: 100px" required></textarea>
                                    <label for="address">Address</label>
                                </div>
                                @if($errors->has('address'))
                                    <small class="form-text text-danger">{{ $errors->first('address') }}</small> 
                                @endif
                            </div>

                            <div class="col-md-5">
                                <div class="form-select-wrapper">
                                    <select class="form-select" name="country" aria-label="country">
                                        <option value="1">UAE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-select-wrapper">
                                    <select class="form-select" name="state" aria-label="state">
                                        @foreach ($states->get() as $state)
                                          <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                 
                            </div>

                            <div class="col-md-3">
                                <div class="form-floating mb-4">
                                    <input id="zip" type="number" name="zip" class="form-control" placeholder="Zip">
                                    <label for="zip">Zip</label>
                                </div>
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <div class="form-check">
                            <input class="form-check-input" name="saveaddress" value="1" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">Save this information for next time</label>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Payment Options</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="paypal" name="paymentMethod" checked="" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="paypal">PayPal</label>
                            </div>
                        </div>

                        <hr class="my-4">

                        <button class="w-100 btn btn-primary btn-lg" type="submit">Checkout</button>
                    </form>
                </div>
            </div>
          </div>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
    
    </section>
  </form>
    <!-- /section -->
@endsection