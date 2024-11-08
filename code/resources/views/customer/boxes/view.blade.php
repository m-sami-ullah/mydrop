@extends('customer.profile.profile_master')

 
@section('profile_header_title','Boxes')
@section('profile_bread_crumb')
<li class="breadcrumb-item">Boxes</li>
@endsection


@section('profile_content')
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
            url: '{{ route('customer.boxes.deviceinfo') }}',
            success: function(rec)
            {
               var ret = JSON.parse(rec);

               if(ret.error==0)
               {
                  var info = ret.data

                  if(info.switch=='off')
                  {
                    $('#door'+deviceid).prop("checked", true);
                  }else{
                    $('#door'+deviceid).prop("checked", false);
                  }   
               }
          }
        });
} 
    </script>

    <h3>{{ $box->gettitle() }} <small>{{ $box->boxnumber }}</small> <div class="float-end small">{{ $box->boxt_type() }}</div></h3>
    <hr class="my-1" />
      @php
        $i=1;
      @endphp
      <div class="row">
      @foreach ($box->switches() as $swch)
        <div class="col-6 col-sm-3">
        <div class="card "  >
             <div class="card-header">
              Door {{ $i++ }}
              </div>
            <img src="" class="card-img-top" alt="">
            <div class="card-body">
              <div class="form-check form-switch">
                <input class="form-check-input dooraction" data-cameraendpoint="{{ $box->camera_endpoint() }}"  data-endpoint="{{ $swch->endpoint() }}" data-port="{{ $swch->port }}" data-ip="{{ $box->ip }}" data-boxid="{{ $box->id }}" type="checkbox" id="door{{ $swch->id }}" style="width:4rem;height:2rem;">
                <label class="form-check-label" for="door{{ $swch->id }}"></label>
              </div>
            </div>
          </div> 
</div>
        
         <script type="text/javascript">
          var url = '{!! $box->ip . ':'. $swch->port !!}/zeroconf/info';
          checkdevicestatus(url,'{{ $swch->id }}')
    </script>
      
      @endforeach
    <hr class="my-1 mt-5" />

    <h3>Image gallery</h3>

   
    <div class="gallerydata">
       <div class="row g-2">
        @foreach ($gallery as $image)
        <div class="col-sm-4">
          <img src="{{ $image->url() }}" width="100%">
        </div>
        @endforeach
      </div>
    </div>

    </div>
                 
     

      <!-- /nav -->

@endsection('content')

@section('web_footer_scripts')

@parent

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
      var boxid = $(this).data('boxid')
      var port = $(this).data('port')
      var endpoint = $(this).data('endpoint')
      var cameraendpoint = $(this).data('cameraendpoint')
      var ex_url = ip + ':' + port + endpoint
      var curl =  cameraendpoint
      var url = '{{ route('customer.boxes.doortoogle') }}' 

      $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {payload:data,url:ex_url,curl:curl,boxid:boxid},
            url: url,
            success: function(rec)
            {

              getgallery()
              // console.log(rec)
          },
          error: function (xhr, desc, err) {             

            $('#script_error').modal('show')
          
         }
        });
     
  })


  function getgallery() 
  {
    $.ajax({
            type: 'get',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '{{ route('customer.getgallery',['box'=>$box->id]) }}',
            success: function(rec)
            {
              $('.gallerydata').html(rec.data)
              
            }
        });
  }
</script>
@endsection





