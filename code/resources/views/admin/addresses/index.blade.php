@extends('layouts.index_master')

    @section('main_title','Addresses')
    @section('alert_section')
        @include('layouts.tabs',['customer'=>$customer])
    @endsection
    
    
    @section('deleteall_route',route('customers.addresses.deleteall',['customer'=>$customer->id])) 

    @section('create_route',route('customers.addresses.create',['customer'=>$customer->id]))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        <li><a href="{{ route("customers.index") }}" >Customers</a></li>

    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Title</th>
			<th>State</th>
			<th>City</th>
			<th>Area</th>
            <th>Boxes</th>

    @endsection
        
    

@section('table_body')

    @foreach($addresses as $address)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $address->id }}" name="actionbtn[{{ $address->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('customers.addresses.edit',['address'=>$address->id,'customer'=>$customer->id])}}" class="href_link">{{ $address->title }}</a>
                                 </td>
			<td>
                                    <a href="{{route('customers.addresses.edit',['address'=>$address->id,'customer'=>$customer->id], ["address"=>$address->id])}}" class="href_link">{{ $address->state ? $address->state->name:"" }}</a>
                                     </td>
			<td>
                                    <a href="{{route('customers.addresses.edit',['address'=>$address->id,'customer'=>$customer->id], ["address"=>$address->id])}}" class="href_link">{{ $address->city ? $address->city->name:"" }}</a>
                                     </td>
			<td>
                                    <a href="{{route('customers.addresses.edit',['address'=>$address->id,'customer'=>$customer->id], ["address"=>$address->id])}}" class="href_link">{{ $address->area ? $address->area->name:"" }}</a>
                                     </td>

                                     <td>
                                    <a href="{{route('customers.addresses.boxes.index',['address'=>$address->id,'customer'=>$customer->id], ["address"=>$address->id])}}" class="href_link">Boxes</a>
                                     </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $address->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
        </tr>
    @endforeach
        
@endsection
 


