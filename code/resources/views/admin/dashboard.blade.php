@extends('layouts.admin_master')

    @section('admin_breadcrumb_heading')
       Dashboard
    @endsection('admin_breadcrumb_heading')

    @section('admin_breadcrumb_links') 
            <li><a href="#" class="active">Dashboard</a></li>
    @endsection('admin_breadcrumb_links')


 

@section('admin_content')
    <!--task distribution start-->
        <div class="row">
            
            <div class="col-md-6 ">
                <div class="panel">
                    <header class="panel-heading panel-border">
                        Login Customers
                    </header>
                    <div class="panel-body">
                         
                        <div class="table-responsive">
                            <table  class="table table-hover latest-order">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>IP</th>
                                    <th>Since</th>
                                </tr>
                                </thead>
                                @php
                                    $active = \App\Models\Active_login::whereHasMorph(
                                                'userable',
                                                [\App\Models\Customer::class],function($q)
                                                {
                                                    // $q->where('token',7);
                                                    // $q->whereRaw(' Hours(created_at) >= 0 && Hours(created_at) <=2');
                                                    // $q-> whereDate('created_at ' , '=',\Carbon\Carbon::today())
                                                         // ->whereTime('created_at' , '>',\Carbon\Carbon::now()->subHours(3));
                                                     // ->whereBetween('created_at', [$startDate, $endDate])
                                                }
                                                
                                            )->get();;
                                @endphp
                                <tbody>
                                    
                                    @foreach ($active as $row)
                                    @php
                                        // $agent  = unserialize($row->details)['HTTP_USER_AGENT'];
                                    @endphp
                                <tr>
                                         
                                    <td>{{ $row->userable->firstname . ' ' .  $row->userable->lastname }}</td>
                                    <td>{{ $row->userable->email }}</td>
                                    <td>{{ $row->ip }}</td>
                                    <td>
                                        {{ $row->created_at->diffForHumans() }}
                                        {{-- {{ $agent }} --}}
                                    </td>
                                </tr>
                                    @endforeach
                                

                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="panel">
                    <header class="panel-heading panel-border">
                        Login Staff
                    </header>
                    <div class="panel-body">
                         
                        <div class="table-responsive">
                            <table  class="table table-hover latest-order">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>IP</th>
                                    <th>Since</th>
                                </tr>
                                </thead>
                                <tbody>
                                	@php
                                		$active = \App\Models\Active_login::whereHasMorph(
                                                'userable',
                                                [\App\Models\User::class],
                                                
                                            )->get();;
                                	@endphp
                                	@foreach ($active as $row)
                                	@php
                                		$agent  = unserialize($row->details)['HTTP_USER_AGENT'];
                                	@endphp
                                <tr>
                                		 
                                    <td>{{ $row->userable->name }}</td>
                                    <td>{{ $row->userable->email }}</td>
                                    <td>{{ $row->ip }}</td>
                                    <td>

                                        {{-- {{ $agent }} --}}
                                        {{ $row->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                                	@endforeach
                                

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
	<!--users login end-->

@endsection()

