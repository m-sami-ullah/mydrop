@extends('layouts.admin_master')

    @section('main_title','Boxdevices')
    
    
    
    {{-- @section('deleteall_route',route('boxes.boxdevices.deleteall',['box'=>$box->id]))  --}}

    {{-- @section('create_route',route('boxes.boxdevices.create',['box'=>$box->id])) --}}
    
    {{-- @section('can_create') --}}
        {{-- @include('layouts.add_button') --}}
        
    {{-- @endsection --}}
    @section('more_breadcrumb')
        <li><a href="{{ route("boxes.index") }}" >Boxes</a></li>

    @endsection

    {{-- @section('can_delete') --}}
        {{-- @include('layouts.delete_button') --}}
    {{-- @endsection --}}

@section('admin_breadcrumb_heading')
       Boxdevices( {{ $box->boxnumber  }} )
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("boxes.index") }}" >Boxes</a></li>
            <li><a href="{{ route("boxes.boxdevices.index",['box'=>$box->id]) }}" >Boxdevices</a></li>

            <li><a href="#" class="active">Add New</a></li>
    @endsection('admin_breadcrumb_links')
 



@section('admin_content')    
    
<script src="{{ URL::asset('admin/bower_components/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ URL::asset('admin/assets/js/init-switchery.js') }}"></script>

    <script type="text/javascript">
 
      function checkdevicestatus(url,deviceid)
      {
        var data = { 
          "deviceid": "", 
          "data": {}
        };
  $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {url:url},
            url: '{{ route('boxes.deviceinfo') }}',
            success: function(rec)
            {
               // console.log(rec)
               var ret = JSON.parse(rec);

                var elem_2 = document.querySelector('.js-switch');
                var switchery = new Switchery(elem_2, { color: '#4aa9e9' });

               if(ret.error==0)
               {
                  var info = ret.data

                  if(info.switch=='off')
                  {
                    $('#door'+deviceid).prop("checked", true);
                    switchery.handleOnchange($('#door'+deviceid).checked);
                  }else{
                    switchery.handleOnchange($('#door'+deviceid).checked);
                  }   
               }
          }
        });
} 
    </script>
    
     <link rel="stylesheet" href="{{ URL::asset('admin/bower_components/switchery/dist/switchery.min.css') }}">

@php
    $i=1;
@endphp

@foreach ($switches as $switche)

    <div class="col-sm-3">
        
        <div class="panel">
            <header class="panel-heading">
                Door {{ $i }}
               
            </header>
            <div class="panel-body">
              
       
                    <div class="form-group">
                        <div class="checkbox col-sm-3">
                            <label for="door{{ $switche->id }}">
                                <input style="opacity: 0" id="door{{ $switche->id }}" data-endpoint="{{ $switche->endpoint() }}" class="js-switch   doors  dooraction" data-port="{{ $switche->port }}" data-ip="{{ $box->ip }}"  value="" type="checkbox" >
                            </label>
                        </div>
                        
                    </div>
            </div>
        </div>
    </div>     

     @php
         $i++;
     @endphp
    
    <script type="text/javascript">
          var url = '{!! $box->ip . ':'. $switche->port !!}/zeroconf/info';
          checkdevicestatus(url,'{{ $switche->id }}')
    </script>
@endforeach

 

        
@endsection
 


@section('more_scripts')
@parent

<script type="text/javascript">
 

</script>
<script type="text/javascript">
  $(document).on('click','.dooraction',function() {

      var status = this.checked ? 'off':'on';

      // console.log(this.checked);
      data = { 
                "deviceid": "", 
                "data": {
                    "switch": status
                } 
             }
      var ip = $(this).data('ip')
      var port = $(this).data('port')
      var endpoint = $(this).data('endpoint')
      var ex_url = ip + ':' + port + endpoint
      var url = '{{ route('boxes.doortoogle') }}' 

      $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {payload:data,url:ex_url},
            url: url,
            success: function(rec)
            {

              console.log(rec)
          }
        });


  })
</script>
@endsection