@extends('layout.oui_master')

@section('meta_title','OUI')

@section('body_class',' bg-accent ')
@section('content')

<!--=====================================-->
        <!--=        Inner Banner Start         =-->
        <!--=====================================-->
        <section class="inner-page-banner inner-page-banner-background" >
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumbs-area">
                            <h1>{{ trans('lang.post_an_ad') }}</h1>
                            <ul>
                                <li>
                                    <a href="{{ route('home') }}">{{ trans('lang.home') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('profile') }}">{{ trans('lang.profile') }}</a>
                                </li>
                                <li>{{ trans('lang.notifications') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=====================================-->
        <!--=        Post Add Start    			=-->
        <!--=====================================-->
        <section class="section-padding-equal-70">
            <div class="container">
                <div class="post-ad-box-layout1 light-shadow-bg">
                    <div class="post-ad-form light-box-content">
                        @include('seller.errors')

                        
                            
                            <div class="post-section post-category">
                                <div class="post-ad-title">
                                    <i class="fas fa-comment"></i>
                                    <h3 class="item-title">{{ trans('lang.notifications') }} 
                                    </h3>

                                </div>
                                
                                <table class="table">
    @php
      $notifications = Auth::guard('oui')->user()->notifications()->paginate(15);
    @endphp
    @if ($notifications)
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">--</th>
      <th scope="col">{{ trans('lang.comment') }}</th>
      <th scope="col">{{ trans('lang.ad_detail') }}</th>
      <th scope="col">{{ trans('lang.date') }} 
      </th>
    </tr>
  </thead>
  <tbody>
        @foreach ($notifications as $notification )
            <tr>
              <th scope="row">{{$loop->iteration}}</th>
              <th scope="row">
                @switch($notification->type)
                      @case('App\Notifications\AdStatusUpdate')

                        {{ 'Update Status' }}
                      @break
                      @case('App\Notifications\AdminComment')
                        {{ 'Admin Comment' }}
                      @break
                      @case('App\Notifications\DeleteAdvertiseReason')
                          {{ 'Delete Ad' }}
                      @break
                  
                       
                  @endswitch</th>
              
              <td> @switch($notification->type)
                      @case('App\Notifications\AdStatusUpdate')
                      @case('App\Notifications\AdminComment')
                      @case('App\Notifications\DeleteAdvertiseReason')
                          {{ array_key_exists('comment', $notification->data) ? $notification->data['comment'] : ''  }}
                      @break
                  
                       
                  @endswitch</td>
              <td>
                {{ array_key_exists('advertise', $notification->data) ? $notification->data['advertise']['title'] : ''  }}</td>
              <td>{{$notification->created_at ? $notification->created_at->diffForHumans():'' }}</td>
            </tr>
        @endforeach 

    
    
  </tbody>
</table>
 
        {{ $notifications->links('pagination::bootstrap-4') }}

    @endif  

                                 
                                 
                            </div>
                         
                    </div>
                </div>
            </div>
        </section>
@endsection

 