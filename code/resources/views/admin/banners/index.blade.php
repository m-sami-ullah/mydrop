@extends('layouts.index_master')

    @section('main_title','Banners')
    
    @section('deleteall_route',route('banners.deleteall')) 

    @section('create_route',route('banners.create'))
    
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
        
@section('alert_section')
    @include('layouts.hometabs')
@endsection()


@section('table_body')


    @foreach($banners as $banner)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $banner->id }}" name="actionbtn[{{ $banner->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('banners.edit',['banner'=>$banner->id])}}" class="href_link">{{ $banner->name }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $banner->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


