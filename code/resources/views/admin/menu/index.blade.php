@extends('layouts.index_master')

    @section('main_title',__('Navigations'))
       
  
 
 
    

    {{-- @section('create_route',route('menu.create')) --}}
    
    @section('can_create')
        Navigations
        
        
    @endsection('can_create')

    
    



    @section('table_head')

    <th>Menu</th>
    <th>Links</th>

    @endsection('table_head')
        
    @section('alert_section')
    @include('layouts.hometabs')
@endsection()

@section('table_body')
        @foreach($menu as $nav)
        <tr>
            <td class="actionbtntd small_action">
                
            </td>
            <td><a href="{{route('nav.edit', ['nav'=>$nav->id])}}" class="href_link">{{ $nav->title }}</a></td>


            <td class="small_action"><a href="{{route('menu.links', ['nav'=>$nav->id])}}" class="href_link">Links</a></td>
             
            <td class="action_col actionbtntd small_action">
                 
            </td>
         </tr>
         @endforeach
        
@endsection('table_body')

@section('datatables_options')
"paging":   false,
        "ordering": false,
        "info":     false
@endsection
 
@section('pagination')
{{ $menu->withQueryString()->onEachSide(5)->links('pagination::bootstrap-4') }}
@endsection

 