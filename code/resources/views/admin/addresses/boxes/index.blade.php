@extends('layouts.index_master')

    @section('main_title',$address->title .' Boxes')
   
    @section('alert_section')
        @include('layouts.tabs',['customer'=>$customer])
    @endsection
    
    
    {{-- @section('deleteall_route',route('customers.addresses.boxes.deleteall',['customer'=>$customer->id,'address'=>$address->id]))  --}}

    {{-- @section('create_route',route('customers.addresses.boxes.create',['customer'=>$customer->id,'address'=>$address->id])) --}}
    
    @section('can_create')
        {{-- @include('layouts.add_button') --}}
        
    @endsection
    @section('more_breadcrumb')
        <li><a href="{{ route("customers.index") }}" >Customers</a></li>

        <li><a href="{{ route("customers.addresses.index",['customer'=>$customer->id]) }}" >Addresses</a></li>
    @endsection

    @section('can_delete')
        {{-- @include('layouts.delete_button') --}}
    @endsection

    @section('table_head')
			<th>Box Number</th>
            <th>QR Code</th>
            <th>Number of Doors</th>
            <th>Status</th>
            <th>Devices</th>

    @endsection
        
    

@section('table_body')
    @foreach($boxes as $box)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $box->id }}" name="actionbtn[{{ $box->id }}]"><i></i>
                </label>
            </td>

                         
             
            <td>
                            <a href="{{route('customers.addresses.boxes.edit',['customer'=> $customer->id,'address'=>$address->id,'box'=>$box->id])}}" class="href_link">{{ $box->boxnumber }}</a>
                                 </td>
            <td>
                            <a href="{{route('customers.addresses.boxes.edit',['customer'=> $customer->id,'address'=>$address->id,'box'=>$box->id])}}" class="href_link">{{ $box->qrcode }}</a>
                                 </td>
            <td>
                            <a href="{{route('customers.addresses.boxes.edit',['customer'=> $customer->id,'address'=>$address->id,'box'=>$box->id])}}" class="href_link">{{ $box->boxtype ? $box::BOXTYPE_SELECT[$box->boxtype] : "" }}</a>
                                 </td>
            <td>
                            <a href="{{route('customers.addresses.boxes.edit',['customer'=> $customer->id,'address'=>$address->id,'box'=>$box->id])}}" class="href_link">{{ $box->status ? $box::STATUS_SELECT[$box->status] : "" }}</a>
                                 </td>
            <td>
                                    <a class="actionbtntd small_action" href="{{route("customer.boxes.devices.index",['customer'=> $customer->id,'address'=>$address->id,'box'=>$box->id])}}" class="href_link">Devices</a>
                                     </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $box->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
     
        
@endsection
 


