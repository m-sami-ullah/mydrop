@extends('layouts.index_master')

    @section('main_title','Pages')
    
    
    
    @section('deleteall_route',route('pages.deleteall')) 

    @section('create_route',route('pages.create'))
    
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

    @endsection
        
    

@section('table_body')

    @foreach($pages as $page)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $page->id }}" name="actionbtn[{{ $page->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('pages.edit',['page'=>$page->id])}}" class="href_link">{{ $page->name }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $page->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


