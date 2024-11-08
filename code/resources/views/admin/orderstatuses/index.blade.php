@extends('layouts.index_master')

    @section('main_title','Order Statuses')
    
    @section('modal_size','modal-sm')
    
    @section('deleteall_route',route('orderstatuses.deleteall')) 

    @section('create_route',route('orderstatuses.create'))
    
    @section('can_create')
        @include('layouts.add_button_modal')
        @include('layouts.edit_button_modal')
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Status</th>

    @endsection
        
    

@section('table_body')

    @foreach($orderstatuses as $orderstatus)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $orderstatus->id }}" name="actionbtn[{{ $orderstatus->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a  data-recordid="{{ $orderstatus->id }}" class="href_link editrecordbtn">{{ $orderstatus->name }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $orderstatus->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 



		@section('add_modal')
		@include('admin.orderstatuses.create')
		@endsection
		@section('more_scripts')
		@parent
		@if(old("id")==NULL && count($errors))
		<script type='text/javascript'>
		$('#addrecordmodal').modal('show') ;
		</script>
		@endif
		<script type="text/javascript">
		$('.editrecordbtn').on('click',function()
		{
		record_id = $(this).attr('data-recordid');
		geteditrecord(record_id,'{{route('orderstatuses.getorderstatus')}}');
		});
		</script>
		@if(count($errors) && old("id")!=NULL)
		<script type="text/javascript">
		geteditrecord({{ old('id') }},'{{route('orderstatuses.getorderstatuses')}}');
		</script>
		@endif
		@endsection