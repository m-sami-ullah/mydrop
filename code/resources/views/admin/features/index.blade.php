@extends('layouts.index_master')

    @section('main_title',$package->name . ' - Features')
    
    
    
    @section('deleteall_route',route('packages.features.deleteall',['package'=>$package->id])) 

    @section('create_route',route('packages.features.create',['package'=>$package->id]))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        <li><a href="{{ route("packages.index") }}" >Packages</a></li>

    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Feature</th>
			<th>Available</th>

    @endsection
        
    

@section('table_body')

    @foreach($features as $feature)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $feature->id }}" name="actionbtn[{{ $feature->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('packages.features.edit',['feature'=>$feature->id,'package'=>$package->id])}}" class="href_link">{{ $feature->name }}</a>
                                 </td>
			<td>
                                    <a href="{{route('packages.features.edit',['feature'=>$feature->id,'package'=>$package->id], ["feature"=>$feature->id])}}" class="href_link">{{ $feature->isAvailable() }}</a>
                                     </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $feature->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


