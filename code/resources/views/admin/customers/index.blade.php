@extends('layouts.index_master')

    @section('main_title','Customers')
    
    
    
    @section('deleteall_route',route('customers.deleteall')) 

    @section('create_route',route('customers.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Status</th>
			<th>Last login</th>
			<th>Login IP</th>
			<th>Addresses</th>

    @endsection
        
    

@section('table_body')

    @foreach($customers as $customer)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $customer->id }}" name="actionbtn[{{ $customer->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('customers.edit',['customer'=>$customer->id])}}" class="href_link">{{ $customer->firstname }}</a>
                                 </td>
			<td>
                            <a href="{{route('customers.edit',['customer'=>$customer->id])}}" class="href_link">{{ $customer->lastname }}</a>
                                 </td>
			<td>
                            <a href="{{route('customers.edit',['customer'=>$customer->id])}}" class="href_link">{{ $customer->email }}</a>
                                 </td>
			<td>
                            <a href="{{route('customers.edit',['customer'=>$customer->id])}}" class="href_link">{{ $customer->status ? $customer::STATUS_SELECT[$customer->status] : "" }}</a>
                                 </td>
			<td>
                            <a href="{{route('customers.edit',['customer'=>$customer->id])}}" class="href_link">{{ $customer->lastlogin }}</a>
                                 </td>
			<td>
                            <a href="{{route('customers.edit',['customer'=>$customer->id])}}" class="href_link">{{ $customer->ip }}</a>
                                 </td>
			<td>
                                    <a class="actionbtntd small_action" href="{{route("customers.addresses.index",['customer'=>$customer->id])}}" class="href_link">Addresses</a>
                                     </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $customer->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


