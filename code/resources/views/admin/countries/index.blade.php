@extends('layouts.index_master')

    @section('main_title','Countries')
    
    
    
    @section('deleteall_route',route('countries.deleteall')) 

    @section('create_route',route('countries.create'))
    
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
			<th>ISO</th>
			<th>Nick Name</th>
			<th>ISO 3 Character Code</th>
			<th>Number Code</th>
			<th>Phone Code</th>

    @endsection
        
    

@section('table_body')

    @foreach($countries as $country)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $country->id }}" name="actionbtn[{{ $country->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('countries.edit',['country'=>$country->id])}}" class="href_link">{{ $country->name }}</a>
                                 </td>
			<td>
                            <a href="{{route('countries.edit',['country'=>$country->id])}}" class="href_link">{{ $country->iso }}</a>
                                 </td>
			<td>
                            <a href="{{route('countries.edit',['country'=>$country->id])}}" class="href_link">{{ $country->nicename }}</a>
                                 </td>
			<td>
                            <a href="{{route('countries.edit',['country'=>$country->id])}}" class="href_link">{{ $country->iso3 }}</a>
                                 </td>
			<td>
                            <a href="{{route('countries.edit',['country'=>$country->id])}}" class="href_link">{{ $country->numcode }}</a>
                                 </td>
			<td>
                            <a href="{{route('countries.edit',['country'=>$country->id])}}" class="href_link">{{ $country->phonecode }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $country->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


