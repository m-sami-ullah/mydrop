
<!--sidebar start-->
<aside id="aside" class="ui-aside">
    <ul class="nav" ui-nav>
        <li class="nav-head">
            <h5 class="nav-title text-uppercase light-txt">Navigation</h5>
        </li>
         <li class="{{ request()->routeis("admindashboard")?"active":"" }}">
            <a href="{{ route('admindashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a>
            <ul class="nav nav-sub">
                <li class="nav-sub-header"><a href="{{ route('admindashboard') }}"><span>Dashboard</span></a></li>
            </ul>
        </li>
        @php
            $administration = request()->routeis("packages.*") ? 1:0;
        @endphp
        <li class="{{$administration==1?'active':''}}">
                        <a href=""><i class="fa fa-clone"></i><span>Administrations</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub" style="{{$administration==1?'display: block':''}}">
                            <li class="">
                                <a href="{{ route("packages.index") }}"><i class="fa fa-money"></i><span>Packages</span></a>
                                <ul class="nav nav-sub">
                                    <li class="nav-sub-header"><a href="{{ route("packages.index") }}"><span>Packages</span></a></li>
                                </ul>
                            </li>
                        </ul>
        </li>
        @php
            $cms = request()->routeIs('config.edit') || request()->routeIs('menu.links') || request()->routeIs('banners.*') || request()->routeIs('pages.*') || request()->routeIs('faqs.*') || request()->routeIs('testimonials.*') || request()->routeIs('services.*') || request()->routeIs('socials.*')? 1:0;
        @endphp
        <li class="{{$cms==1?'active':''}}">
            <a href=""><i class="fa fa-clone"></i><span>CMS</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="nav nav-sub" style="{{$cms==1?'display: block':''}}">

                        <li class="">
                            <a href="{{ route('config.edit',['config'=>1]) }}"><i class="fa fa-home"></i><span>Home</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route('config.edit',['config'=>1]) }}"><span>Home</span></a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="{{ route('menu.links',['nav'=>1]) }}"><i class="fa fa-sitemap"></i><span>Main Menu</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route('menu.links',['nav'=>1]) }}"><span>Main Menu</span></a></li>
                            </ul>
                        </li>
                       
                        <li class="">
                            <a href="{{ route("banners.index") }}"><i class="fa fa-image"></i><span>Banners</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("banners.index") }}"><span>Banners</span></a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route("pages.index") }}"><i class="fa fa-edit"></i><span>Pages</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("pages.index") }}"><span>Pages</span></a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route("faqs.index") }}"><i class="fa fa-question"></i><span>FAQ</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("faqs.index") }}"><span>FAQ</span></a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route("testimonials.index") }}"><i class="fa fa-quote-left"></i><span>Testimonials</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("testimonials.index") }}"><span>Testimonials</span></a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="{{ route("services.index") }}"><i class="fa fa-heartbeat"></i><span>Services</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("services.index") }}"><span>Services</span></a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route("socials.index") }}"><i class="fa fa-facebook-square"></i><span>Social Media</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("socials.index") }}"><span>Social Media</span></a></li>
                            </ul>
                        </li>
                    </ul>
            </li>
            @php
            $setups = request()->routeIs('countries.*') ||request()->routeIs('states.*') ||request()->routeIs('orderstatuses.*') ||request()->routeIs('invoicestatuses.*') || request()->routeIs('cities.*') || request()->routeIs('areas.*') ? 1:0;
        @endphp
            <li class="{{$setups==1?'active':''}}">
                        <a href=""><i class="fa fa-gear"></i><span>Setups</span><i class="fa fa-angle-right pull-right"></i></a>
                        <ul class="nav nav-sub" style="{{$setups==1?'display: block':''}}">
                        <li class="">
                            <a href="{{ route("countries.index") }}"><i class="fa fa-location-arrow"></i><span>Countries</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("countries.index") }}"><span>Countries</span></a></li>
                            </ul>
                        </li>
                            <li class="">
                            <a href="{{ route("states.index") }}"><i class="fa fa-location-arrow"></i><span>States</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("states.index") }}"><span>States</span></a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route("cities.index") }}"><i class="fa fa-map-marker"></i><span>Cities</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("cities.index") }}"><span>Cities</span></a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="{{ route("areas.index") }}"><i class="fa fa-map-marker"></i><span>Areas</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("areas.index") }}"><span>Areas</span></a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="{{ route("orderstatuses.index") }}"><i class="fa fa-edit"></i><span>Order Status</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("orderstatuses.index") }}"><span>Order Status</span></a></li>
                            </ul>
                        </li>

                        <li class="">
                            <a href="{{ route("invoicestatuses.index") }}"><i class="fa fa-edit"></i><span>Invoice Status</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("invoicestatuses.index") }}"><span>Invoice Status</span></a></li>
                            </ul>
                        </li>
                    </ul>
            </li>
            <li class="{{ request()->routeis("groups.*")?"active":"" }}">
                            <a href="{{ route("groups.index") }}"><i class="fa fa-users"></i><span>Groups</span></a>
                            <ul class="nav nav-sub">
                                <li class="nav-sub-header"><a href="{{ route("groups.index") }}"><span>Groups</span></a></li>
                            </ul>
                        </li>
            <li class="{{ request()->routeis("users.*")?"active":"" }}">
                    <a href="{{ route("users.index") }}"><i class="fa fa-vcard-o"></i><span>Users</span></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href="{{ route("users.index") }}"><span>Users</span></a></li>
                    </ul>
                </li>
            <li class="{{ request()->routeis("customers.*")?"active":"" }}">
                    <a href="{{ route("customers.index") }}"><i class="fa fa-user-o"></i><span>Customers</span></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href="{{ route("customers.index") }}"><span>Customers</span></a></li>
                    </ul>
                </li>
            <li class="{{ request()->routeis("devices.*")?"active":"" }}">
                    <a href="{{ route("devices.index") }}"><i class="fa fa-toggle-on"></i><span>Devices</span></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href="{{ route("devices.index") }}"><span>Devices</span></a></li>
                    </ul>
                </li>

                 <li class="{{ request()->routeis("boxes.*")?"active":"" }}">
                    <a href="{{ route("boxes.index") }}"><i class="fa fa-toggle-on"></i><span>Boxes</span></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href="{{ route("boxes.index") }}"><span>Boxes</span></a></li>
                    </ul>
                </li>

                <li class="{{ request()->routeis("orders.*")?"active":"" }}">
                    <a href="{{ route("orders.index") }}"><i class="fa fa-list"></i><span>Orders</span></a>
                    <ul class="nav nav-sub">
                        <li class="nav-sub-header"><a href="{{ route("orders.index") }}"><span>Orders</span></a></li>
                    </ul>
                </li>


    </ul>
</aside>
