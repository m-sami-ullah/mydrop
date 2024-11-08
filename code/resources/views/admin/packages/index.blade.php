@extends('layouts.index_master')

    @section('main_title','Packages')
    
    
    
    @section('deleteall_route',route('packages.deleteall')) 

    @section('create_route',route('packages.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Package Name</th>
			<th>Price</th>
			<th>Duration</th>
			<th>Features</th>

    @endsection
        
    

@section('table_body')

    @foreach($packages as $package)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $package->id }}" name="actionbtn[{{ $package->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('packages.edit',['package'=>$package->id])}}" class="href_link">{{ $package->name }}</a>
                                 </td>
			<td>
                            <a href="{{route('packages.edit',['package'=>$package->id])}}" class="href_link">{{ $package->price }}</a>
                                 </td>
			<td>
                            <a href="{{route('packages.edit',['package'=>$package->id])}}" class="href_link">{{ $package->duration}}</a>
                                 </td>
			<td>
                                    <a class="actionbtntd small_action" href="{{route("packages.features.index",['package'=>$package->id])}}" class="href_link">Features</a>
                                     </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $package->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


