@extends('layouts.index_master')

    @section('main_title','Services')
    
    
    
    @section('deleteall_route',route('services.deleteall')) 

    @section('create_route',route('services.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Title</th>
			<th>Image</th>
			<th>Status</th>

    @endsection

@section('alert_section')
    @include('layouts.hometabs')
@endsection()        
    

@section('table_body')

    @foreach($services as $service)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $service->id }}" name="actionbtn[{{ $service->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('services.edit',['service'=>$service->id])}}" class="href_link">{{ $service->title }}</a>
                                 </td>
			   
			<td>
                            <a href="{{route('services.edit',['service'=>$service->id])}}" class="href_link"><img src="{{ $service->getimage() }}" height="35"></a>
                                 </td>
			<td>
                            <a href="{{route('services.edit',['service'=>$service->id])}}" class="href_link">{{ $service->status ? $service::STATUS_SELECT[$service->status] : "" }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $service->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


