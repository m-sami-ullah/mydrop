@extends('layouts.index_master')

    @section('main_title','Groups')
    
    
    
    @section('deleteall_route',route('groups.deleteall')) 

    @section('create_route',route('groups.create'))
    
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
			<th>Status</th>

    @endsection
        
    

@section('table_body')

    @foreach($groups as $group)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $group->id }}" name="actionbtn[{{ $group->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('groups.edit',['group'=>$group->id])}}" class="href_link">{{ $group->name }}</a>
                                 </td>
			<td>
                            <a href="{{route('groups.edit',['group'=>$group->id])}}" class="href_link">{{ $group->status ? $group::STATUS_SELECT[$group->status] : "" }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $group->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


