@extends('customer.profile.profile_master')

 
@section('profile_header_title','Orders')
@section('profile_bread_crumb')
<li>Orders</li>
@endsection

@section('profile_content')
  <h3>Addresses</h3>
  <a class="float-right btn btn-success btn-sm" href="{{ route('customer.addresses.addnew') }}">Add New</a>
    <hr class="my-1" />

      <div class="table-responsive">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th scope="col">Title</th>
                      <th scope="col">State</th>
                      <th scope="col">City</th>
                      <th scope="col">Area</th>
                      <th scope="col">Post Code</th>
                  </tr>
              </thead>
              <tbody>
                @foreach (Auth::guard('customer')->user()->addresses as $address)
                
                  <tr>
                      <th scope="row">{{ $address->title }}</th>
                      <th scope="row">{{ $address->getstate() }}</th>
                      <th scope="row">{{ $address->getcity() }}</th>
                      <th scope="row">{{ $address->getarea() }}</th>
                      <th scope="row">{{ $address->postcode }}</th>
                     
                  </tr>
                @endforeach 
              </tbody>
          </table>
      </div>
      <!-- /nav -->

@endsection('content')

@section('web_footer_scripts')

@parent


@endsection





