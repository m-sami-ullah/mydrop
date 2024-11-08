@extends('layouts.index_master')

    @section('main_title','Faqs')
    
    
    
    @section('deleteall_route',route('faqs.deleteall')) 

    @section('create_route',route('faqs.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Question</th>
			<th>Answer</th>
			<th>Status</th>

    @endsection
        
@section('alert_section')
    @include('layouts.hometabs')
@endsection()    

@section('table_body')

    @foreach($faqs as $faq)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $faq->id }}" name="actionbtn[{{ $faq->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('faqs.edit',['faq'=>$faq->id])}}" class="href_link">{{ $faq->question }}</a>
                                 </td>
			<td>
                            <a href="{{route('faqs.edit',['faq'=>$faq->id])}}" class="href_link">{{ $faq->answer }}</a>
                                 </td>
			<td>
                            <a href="{{route('faqs.edit',['faq'=>$faq->id])}}" class="href_link">{{ $faq->status ? $faq::STATUS_SELECT[$faq->status] : "" }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $faq->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


