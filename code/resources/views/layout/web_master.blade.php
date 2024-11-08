@extends('layout.master')

@section('web_header')
    @include('layout.header')
@endsection('web_header')




@section('web_content')
<div class="page-content">
    @yield('content')
</div>
@endsection('web_content')





@section('web_footer')
    @include('layout.footer')
@endsection('web_footer')