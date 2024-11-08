@extends('layouts.index_master')

    @section('main_title','Devices')
    
    
    
    @section('deleteall_route',route('boxes.boxdevices.deleteall',['box'=>$box->id])) 

    @section('create_route',route('boxes.boxdevices.create',['box'=>$box->id]))
    
    @section('can_create')
        Devices <small>{{ $box->boxnumber }}</small>
    @endsection
    {{-- @section('small_action_checkbox','') --}}
    @section('table_action','')
    @section('datatable_class','')
    @section('more_breadcrumb')
        <li><a href="{{ route("boxes.index") }}" >Boxes</a></li>

    @endsection


    @section('table_head')
      <th>Name</th>
      <th>Device Type</th>
      <th>Port</th>
      <th>FCC ID</th>
      <th>Device Model</th>

    @endsection
        
    

@section('table_body')

    @foreach($boxdevices as $boxdevice)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $boxdevice->id }}" name="actionbtn[{{ $boxdevice->id }}]"><i></i>
                </label>
            </td>

             <td>
                                    <a href="{{route('boxes.boxdevices.edit',['boxdevice'=>$boxdevice->id,'box'=>$box->id], ["boxdevice"=>$boxdevice->id])}}" class="href_link">{{ $boxdevice->device ? $boxdevice->device->name:"" }}</a>
                                     </td>

                 <td>
                            <a href="{{route('boxes.boxdevices.edit',['boxdevice'=>$boxdevice->id,'box'=>$box->id], ["boxdevice"=>$boxdevice->id])}}" class="href_link">{{ $boxdevice->device->boxtype ? \App\Models\Device::TYPE_SELECT[$boxdevice->device->boxtype]:'' }}</a>
                                 </td>

                  <td>
                            <a href="{{route('boxes.boxdevices.edit',['boxdevice'=>$boxdevice->id,'box'=>$box->id], ["boxdevice"=>$boxdevice->id])}}" class="href_link">{{ $boxdevice->device->port }}</a>
                                 </td>
      <td>
                            <a href="{{route('boxes.boxdevices.edit',['boxdevice'=>$boxdevice->id,'box'=>$box->id], ["boxdevice"=>$boxdevice->id])}}" class="href_link">{{ $boxdevice->device->deviceid }}</a>
                                 </td>
      
      <td>
                            <a href="{{route('boxes.boxdevices.edit',['boxdevice'=>$boxdevice->id,'box'=>$box->id], ["boxdevice"=>$boxdevice->id])}}" class="href_link">{{ $boxdevice->device->model }}</a>
                                 </td>
     
       

             
            
     </tr>
     @endforeach
        
@endsection
 


