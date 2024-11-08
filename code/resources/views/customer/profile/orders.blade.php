@extends('customer.profile.profile_master')

 
@section('profile_header_title','Orders')
@section('profile_bread_crumb')
<li>Orders</li>
@endsection

@section('profile_content')
    <h3>Orders</h3>
    <hr class="my-1" />


      <div class="table-responsive">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th scope="col">Order</th>
                      <th scope="col">Plan</th>
                      <th scope="col">Date</th>
                      <th scope="col">Status</th>
                      <th scope="col">Total</th>
                  </tr>
              </thead>
              <tbody>
                @foreach (Auth::guard('customer')->user()->orders as $order)
                
                  <tr>
                      <th scope="row">#{{ $order->id }}</th>
                      <td>{{ $order->created_at->format('M, d Y') }}</td>
                      <td>{{ $order->package }}</td>
                      <td>{{ $order->order_status() }}</td>
                      <td>USD {{ $order->total }}</td>
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





