@extends('layouts.index_master')

    @section('main_title','Invoice Statuses')
    
    @section('modal_size','modal-sm')
    
    @section('deleteall_route',route('invoicestatuses.deleteall')) 

    @section('create_route',route('invoicestatuses.create'))
    
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

    @foreach($invoicestatuses as $invoicestatus)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $invoicestatus->id }}" name="actionbtn[{{ $invoicestatus->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a data-recordid="{{ $invoicestatus->id }}" class="href_link editrecordbtn">{{ $invoicestatus->name }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $invoicestatus->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 



		@section('add_modal')
		@include('admin.invoicestatuses.create')
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
		geteditrecord(record_id,'{{route('invoicestatuses.getinvoicestatus')}}');
		});
		</script>
		@if(count($errors) && old("id")!=NULL)
		<script type="text/javascript">
		geteditrecord({{ old('id') }},'{{route('invoicestatuses.getinvoicestatuses')}}');
		</script>
		@endif
		@endsection