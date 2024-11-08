@extends('layouts.index_master')

    @section('main_title',__('Notifications'))
    @section('aside-compact','ui-aside-compact')   
    
    @section('datatable_class','')
 
 
    

 


    



    @section('table_head')

    <th>Notification</th>
    <th>Read</th>

    @endsection('table_head')
        
    
@section('table_body')
        @foreach($notifications as $notification)

        @php
            switch($notification->type)
            {
                case 'App\Notifications\NewAdPosted':
                    $type = 'New Advertise Posted';
                    $route = route('ad-show',['slug'=>$notification->data['advertise']['slug']]);
                    $icon = 'fa-plus';
                    $class = 'success';
                break;

                case 'App\Notifications\Admin\AdReported':
                    $type = 'New Advertise Reported';
                    $route = route('ad-show',['slug'=>$notification->data['advertise']['slug']]);
                    $icon = 'fa-warning';
                    $class = 'danger';
                break;
            
                default:
                   $route = $type = ''; 
               break;    
            }
        @endphp
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $notification->id }}" name="actionbtn[{{ $notification->id }}]"><i></i>
                </label>
            </td>
            <td>{{ $type }}</td>
             
            <td>{{ $notification->read_at }}</td>
             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                        <button onclick="deleterecord({{ $notification->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
         </tr>
         @endforeach
        
@endsection('table_body')
 
 

 