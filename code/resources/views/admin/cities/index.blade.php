@extends('layouts.index_master')

    @section('main_title','Cities')
    
    
    
    @section('deleteall_route',route('cities.deleteall')) 

    @section('create_route',route('cities.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Name</th>
			<th>State</th>

    @endsection
        
    

@section('table_body')

    @foreach($cities as $city)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $city->id }}" name="actionbtn[{{ $city->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('cities.edit',['city'=>$city->id])}}" class="href_link">{{ $city->name }}</a>
                                 </td>
			<td>
                                    <a href="{{route('cities.edit',['city'=>$city->id], ["city"=>$city->id])}}" class="href_link">{{ $city->state ? $city->state->name:"" }}</a>
                                     </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $city->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


