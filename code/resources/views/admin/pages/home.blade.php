@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Customers
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="{{ route("customers.index") }}" >Customers</a></li>
            <li><a href="#" class="active">Edit</a></li>
    @endsection('admin_breadcrumb_links')
 


@section('admin_content')

@include('layouts.hometabs')

<form class="form-horizontal"   method="post" action="" enctype="multipart/form-data">
<div id="tab1" class="tab-pane fade active in">
	 
</form>
@endsection('admin_content')