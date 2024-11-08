@extends('layouts.index_master')

    @section('main_title','Areas')
    
    
    
    @section('deleteall_route',route('areas.deleteall')) 

    @section('create_route',route('areas.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>City</th>
			<th>Name</th>

    @endsection
        
    

@section('table_body')

    @foreach($areas as $area)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $area->id }}" name="actionbtn[{{ $area->id }}]"><i></i>
                </label>
            </td>

            			<td>
                                    <a href="{{route('areas.edit',['area'=>$area->id], ["area"=>$area->id])}}" class="href_link">{{ $area->city ? $area->city->name:"" }}</a>
                                     </td>
			<td>
                            <a href="{{route('areas.edit',['area'=>$area->id])}}" class="href_link">{{ $area->name }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $area->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


