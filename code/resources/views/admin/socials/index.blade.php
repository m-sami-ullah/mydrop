@extends('layouts.index_master')

    @section('main_title',__('Social Media'))
       
    @section('datatable_class','')
 
 
    @section('deleteall_route',route('socials.deleteall')) 

    @section('create_route',route('socials.create'))
    
    @section('can_create')
        
        <link rel="stylesheet" href="{{ URL::asset('dependencies/fontawesome/css/all.min.css') }}">

            @include('layouts.add_button')
        
    @endsection('can_create')

    @section('can_delete')
            @include('layouts.delete_button')
        
    @endsection('can_delete')


    



    @section('table_head')

    <th>Font Awesome</th>
    <th>Link</th>
    <th>Enable</th>

    @endsection('table_head')
        
    @section('alert_section')
    @include('layouts.hometabs')
@endsection()

@section('table_body')
        @foreach($socials as $social)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $social->id }}" name="actionbtn[{{ $social->id }}]"><i></i>
                </label>
            </td>
            <td><a href="{{route('socials.edit', ['social'=>$social->id])}}" class="href_link"><i class="uil uil-{{ $social->icon }}"></i></a></td>
            <td><a href="{{route('socials.edit', ['social'=>$social->id])}}" class="href_link">{{ $social->link }}</a></td>
            <td><a href="{{route('socials.edit', ['social'=>$social->id])}}" class="href_link">{{ $social->isEnable() }}</a></td>
             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                        <button onclick="deleterecord({{ $social->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
         </tr>
         @endforeach
        
@endsection('table_body')
 


 