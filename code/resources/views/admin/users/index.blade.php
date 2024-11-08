@extends('layouts.index_master')

    @section('main_title','Users')
    
    
    
    @section('deleteall_route',route('users.deleteall')) 

    @section('create_route',route('users.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Full Name</th>
			<th>Email Address</th>
			<th>Status</th>

    @endsection
        
    

@section('table_body')

    @foreach($users as $user)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $user->id }}" name="actionbtn[{{ $user->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('users.edit',['user'=>$user->id])}}" class="href_link">{{ $user->name }}</a>
                                 </td>
			<td>
                            <a href="{{route('users.edit',['user'=>$user->id])}}" class="href_link">{{ $user->email }}</a>
                                 </td>
			<td>
                            <a href="{{route('users.edit',['user'=>$user->id])}}" class="href_link">{{ $user->activated ? $user::ACTIVATED_SELECT[$user->activated] : "" }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $user->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


