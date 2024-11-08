@extends('layouts.index_master')

    @section('main_title','Devices')
    
    
    
    @section('deleteall_route',route('devices.deleteall')) 

    @section('create_route',route('devices.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Device Type</th>
			<th>Name</th>
			<th>FCC ID</th>
			<th>Device Model</th>

    @endsection
        
    

@section('table_body')

    @foreach($devices as $device)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $device->id }}" name="actionbtn[{{ $device->id }}]"><i></i>
                </label>
            </td>

            <td>
                            <a href="{{route('devices.edit',['device'=>$device->id])}}" class="href_link">{{ $device->boxtype ? \App\Models\Device::TYPE_SELECT[$device->boxtype]:'' }}</a>
                                 </td>

            			<td>
                            <a href="{{route('devices.edit',['device'=>$device->id])}}" class="href_link">{{ $device->name }}</a>
                                 </td>
			<td>
                            <a href="{{route('devices.edit',['device'=>$device->id])}}" class="href_link">{{ $device->deviceid }}</a>
                                 </td>
			
			<td>
                            <a href="{{route('devices.edit',['device'=>$device->id])}}" class="href_link">{{ $device->model }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $device->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


