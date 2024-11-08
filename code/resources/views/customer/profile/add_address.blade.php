@extends('customer.profile.profile_master')

 
@section('profile_header_title','Account Details')
@section('profile_bread_crumb')
<li>Account Details</li>
@endsection

@section('profile_content')
@inject('states','App\Models\State')

   <form    method="post" action="{{ route('customer.addresses.store') }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="post-section basic-information">
          <div class="post-ad-title">
              <i class="fas fa-user"></i>
              <h3 class="item-title">Add Address</h3>
          </div>
          <div class="form-floating mb-4 col">
                <input  name="title" type="text" value="" class="form-control" placeholder="Title">
                <label for="">Title</label>
                @if($errors->has('title'))
                      <small class="form-text text-danger">{{ $errors->first('title') }}</small> 
                  @endif 
              </div>
          <div class="row">
            
              <div class="form-floating mb-4 col">
                <select  required="required" name="state_id" id="state" class="form-control" placeholder="State">
                    <option value="">--select state--</option>
                  @foreach ($states->get() as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                  @endforeach
                </select>
                <label for="">State</label>
                  @if($errors->has('state_id'))
                      <small class="form-text text-danger">{{ $errors->first('state_id') }}</small> 
                  @endif 
              </div>
              <div class="form-floating mb-4 col">
              <select  required="required" name="city_id" id="city" class="form-control" placeholder="City">
              </select>
              <label for="">City</label>
                @if($errors->has('city_id'))
                    <small class="form-text text-danger">{{ $errors->first('city_id') }}</small> 
                @endif 
            </div>
          </div>

          <div class="row">
            <div class="form-floating mb-4 col">
              <select  required="required" name="area_id" id="area" class="form-control" placeholder="Area">
              </select>
              <label for="">Area</label>
                @if($errors->has('area_id'))
                    <small class="form-text text-danger">{{ $errors->first('area_id') }}</small> 
                @endif 
            </div>

            <div class="form-floating mb-4 col">
              <input  name="postcode" type="text" value="" class="form-control" placeholder="Zip Code">
                <label for="">Zip Code</label>
                @if($errors->has('postcode'))
                    <small class="form-text text-danger">{{ $errors->first('postcode') }}</small> 
                @endif 
            </div>
          </div>
              

           

              <div class="form-floating mb-4">
                <textarea  required="required"  class="form-control" name="streetaddress" class="form-control" placeholder="Address"></textarea>
                <label for="">Address</label>
                 @if($errors->has('streetaddress'))
                      <small class="form-text text-danger">{{ $errors->first('streetaddress') }}</small> 
                  @endif 
              </div>
              
           <div class="form-floating mb-4">
                      <input type="submit" class="btn btn-primary" value="Update">
          </div>
           
      </div>
       
  </form>
@endsection('content')

@section('web_footer_scripts')

@parent

<script type="text/javascript">
    (function($) {

    'use strict';

        $(document).on('change','#state',function() {
            $('#city').html('');
            var id = $(this).val();
            if (id) 
            {
                get_city(id,null)
            }
             
            return false;

         });

        $(document).on('change','#city',function() {
            $('#area').html('');
            var state_id = $(this).val();
            var city_id = $(this).val();
            if (city_id) 
            {
                get_area(city_id,null)
            }
             
            return false;

         });
         
    get_city('{{ old('state') }}','{{ old('city') }}')
    function get_city(state,city) 
    {
        $.ajax({
            type: 'get',
            url: '{{route("getcities")}}',
            data: { state_id: state,id:city },
            success: function(rec){ 
               $('#city').html(rec);
            }
        
            });
    } 

    get_area('{{ old('city') }}','{{ old('area') }}')
    function get_area(city,area) 
    {
        $.ajax({
            type: 'get',
            url: '{{route("getareas")}}',
            data: { city_id: city,area_id:area },
            success: function(rec){ 
               $('#area').html(rec);
            }
        
            });
    }    
    })(window.jQuery);    
</script>
@endsection





