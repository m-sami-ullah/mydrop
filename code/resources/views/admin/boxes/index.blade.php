@extends('layouts.index_master')

    @section('main_title','Boxes')
    
    
    
    @section('deleteall_route',route('boxes.deleteall')) 

    @section('create_route',route('boxes.create'))
    
    @section('can_create')
        {{-- @include('layouts.add_button') --}}
        
        <a  href="{{ route('boxes.generate') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Generate Boxes</a>
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Title</th>
            <th>Box Number</th>
			<th>IP</th>
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
                            <a href="{{route('boxes.edit',['box'=>$box->id])}}" class="href_link">{{ $box->title }}</a>
                                 </td><td>
                            <a href="{{route('boxes.edit',['box'=>$box->id])}}" class="href_link">{{ $box->boxnumber }}</a>
                                 </td>
			<td>
                            <a href="{{route('boxes.edit',['box'=>$box->id])}}" class="href_link">{{ $box->ip }}</a>
                                 </td>
			<td>
                            <a href="{{route('boxes.edit',['box'=>$box->id])}}" class="href_link">{{ $box->boxtype ? $box::BOXTYPE_SELECT[$box->boxtype] : "" }}</a>
                                 </td>
			<td>
                            <a href="{{route('boxes.edit',['box'=>$box->id])}}" class="href_link">{{ $box->status ? $box::STATUS_SELECT[$box->status] : "" }}</a>
                                 </td>
			<td>
                                    <a class="actionbtntd small_action" href="{{route("boxes.boxdevices.index",['box'=>$box->id])}}" class="href_link">Devices</a>
                                     </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $box->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


