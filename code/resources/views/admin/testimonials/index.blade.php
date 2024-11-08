@extends('layouts.index_master')

    @section('main_title','Testimonials')
    
    
    
    @section('deleteall_route',route('testimonials.deleteall')) 

    @section('create_route',route('testimonials.create'))
    
    @section('can_create')
        @include('layouts.add_button')
        
    @endsection
    @section('more_breadcrumb')
        
    @endsection

    @section('can_delete')
        @include('layouts.delete_button')
    @endsection

    @section('table_head')
			<th>Full Name</th>
			<th>Position</th>
			<th>Testimonials</th>
			<th>Status</th>

    @endsection
        
@section('alert_section')
    @include('layouts.hometabs')
@endsection()

@section('table_body')

    @foreach($testimonials as $testimonial)
        <tr>
            <td class="actionbtntd small_action">
                <label class="i-checks">
                    <input  type="checkbox" class="selectone" value="{{ $testimonial->id }}" name="actionbtn[{{ $testimonial->id }}]"><i></i>
                </label>
            </td>

            			<td>
                            <a href="{{route('testimonials.edit',['testimonial'=>$testimonial->id])}}" class="href_link">{{ $testimonial->name }}</a>
                                 </td>
			<td>
                            <a href="{{route('testimonials.edit',['testimonial'=>$testimonial->id])}}" class="href_link">{{ $testimonial->position }}</a>
                                 </td>
			<td>
                            <a href="{{route('testimonials.edit',['testimonial'=>$testimonial->id])}}" class="href_link">{{ $testimonial->description }}</a>
                                 </td>
			<td>
                            <a href="{{route('testimonials.edit',['testimonial'=>$testimonial->id])}}" class="href_link">{{ $testimonial->status ? $testimonial::STATUS_SELECT[$testimonial->status] : "" }}</a>
                                 </td>

             
            <td class="action_col actionbtntd small_action">
                <span class="lang-flag">
                    <button onclick="deleterecord({{ $testimonial->id }})"  type="button"  class="btn text-danger"><i class="fa fa-trash fa-lg"></i></button>
                </span>
            </td>
     </tr>
     @endforeach
        
@endsection
 


