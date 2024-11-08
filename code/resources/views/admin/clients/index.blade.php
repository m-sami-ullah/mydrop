@extends('layouts.index_master')

    @section('main_title','Clients')
    
    @section('modal_size','modal-lg')
    
    @section('deleteall_route',route('clients.deleteall')) 

    @section('create_route',route('clients.create'))
    
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
			<th>Title</th>
			<th>Logo</th>

    @endsection
        
    
@section('alert_section')
    @include('layouts.hometabs')
@endsection()    


@section('table_body')

    @foreach($clients as $client)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $client->id }}" name="actionbtn[{{ $client->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a data-recordid="{{ $client->id }}" class="href_link editrecordbtn">{{ $client->name }}</a>
                                 </td>
			<td>
                            <a data-recordid="{{ $client->id }}" class="href_link editrecordbtn"><img src="{{ $client->getlogo() }}" height="35"></a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $client->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 



		@section('add_modal')
		@include('admin.clients.create')
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
		geteditrecord(record_id,'{{route('clients.getclient')}}');
		});
		</script>
		@if(count($errors) && old("id")!=NULL)
		<script type="text/javascript">
		geteditrecord({{ old('id') }},'{{route('clients.getclients')}}');
		</script>
		@endif
		@endsection