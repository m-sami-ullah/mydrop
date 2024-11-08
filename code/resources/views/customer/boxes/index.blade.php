@extends('customer.profile.profile_master')

 
@section('profile_header_title','Boxes')
@section('profile_bread_crumb')
<li class="breadcrumb-item">Boxes</li>
@endsection

@section('profile_content')
    <h3>Boxes</h3>
    <hr class="my-1" />

 
  <div class="row">
                @foreach (Auth::guard('customer')->user()->boxes as $box)
                
                  
                    <div class="card col ms-1 me-1" style="width: 18rem;">
                     <div class="card-header">
                        {{ $box->boxt_type() }}
                      </div>
                    <img src="" class="card-img-top" alt="">
                    <div class="card-body">
                      <h5 class="card-title">{{ $box->gettitle() }} <small>{{ $box->boxnumber }}</small></h5>
                      <p class="card-text">{{ $box->address->title }}</p>
                      <a href="{{ route('customer.boxes.show',['box'=>$box->id]) }}" class="btn btn-primary btn-sm">Details</a>
                    </div>
                  </div> 
                 
                @endforeach 
            
     </div>

      <!-- /nav -->

@endsection('content')

@section('web_footer_scripts')

@parent


@endsection





