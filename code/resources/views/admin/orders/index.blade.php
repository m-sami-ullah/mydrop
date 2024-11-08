@extends('layouts.index_master')

    @section('main_title','Orders')
    
    
    
    @section('deleteall_route',route('orders.deleteall')) 

    @section('create_route',route('orders.create'))
    
    @section('can_create') 
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Package Name</th>
			<th>Customer</th>
			<th>Payed</th>
			<th>Payment Method</th>
            <th>Invoice Number</th>
            <th>Invoice Status</th>
            <th>Order Status</th>

    @endsection
        
    

@section('table_body')

    @foreach($orders as $order)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $order->id }}" name="actionbtn[{{ $order->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('orders.edit',['order'=>$order->id])}}" class="href_link">{{ $order->package }}</a>
                                 </td>
			<td>
                            <a href="{{route('orders.edit',['order'=>$order->id])}}" class="href_link">{{ $order->customername() }}</a>
                                 </td>
			<td>
                            <a href="{{route('orders.edit',['order'=>$order->id])}}" class="href_link">{{ $order->price}}</a>
                                 </td>
                                 <td>
                            <a href="{{route('orders.edit',['order'=>$order->id])}}" class="href_link">{{ $order->payment_type}}</a>
                                 </td>

                                 <td>
                            <a href="{{route('orders.edit',['order'=>$order->id])}}" class="href_link">{{ $order->invoice_number}}</a>
                                 </td>

                                 <td>
                            <a href="{{route('orders.edit',['order'=>$order->id])}}" class="href_link">{{ $order->invoice_status()}}</a>
                                 </td>

                                 <td>
                            <a href="{{route('orders.edit',['order'=>$order->id])}}" class="href_link">{{ $order->order_status()}}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $order->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


