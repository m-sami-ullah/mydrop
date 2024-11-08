@extends('layouts.index_master')

    @section('main_title','States')
    
    
    
    @section('deleteall_route',route('states.deleteall')) 

    @section('create_route',route('states.create'))
    
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

    @endsection
        
    

@section('table_body')

    @foreach($states as $state)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $state->id }}" name="actionbtn[{{ $state->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('states.edit',['state'=>$state->id])}}" class="href_link">{{ $state->name }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $state->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


