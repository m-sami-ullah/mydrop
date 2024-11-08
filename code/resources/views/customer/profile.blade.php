@extends('layout.oui_master')

@section('content')
<h1>Profile</h1>
<form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        {{ csrf_field() }}
                        <button class="btn " type="submit">Logout</button>
                    </form>
@endsection('content')







