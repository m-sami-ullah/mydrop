<!--header start-->
<header id="header" class="ui-header ui-header--blue text-white">

    <div class="navbar-header">
        <!--logo start-->
        <a href="{{ route('admindashboard') }}" class="navbar-brand">
            <span class="logo">Mydrop</span>
            <span class="logo-compact">Mydrop</span>
        </a>
        <!--logo end-->
    </div>

    <div class="search-dropdown dropdown pull-right visible-xs">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-search"></i></button>
        <div class="dropdown-menu">
            <form >
                <input class="form-control" placeholder="Search here..." type="text">
            </form>
        </div>
    </div>

    <div class="navbar-collapse nav-responsive-disabled">

        <!--toggle buttons start-->
        <ul class="nav navbar-nav">
            <li>
                <a class="toggle-btn" data-toggle="ui-nav" href="">
                    <i class="fa fa-bars"></i>
                </a>
            </li>
        </ul>
        <!-- toggle buttons end -->

        <!--search start-->
        <form class="search-content hidden-xs" >
            <button type="submit" name="search" class="btn srch-btn">
                <i class="fa fa-search"></i>
            </button>
            <input type="text" class="form-control" name="keyword" placeholder="Search here...">
        </form>
        <!--search end-->

        <!--notification start-->
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-usermenu">
                <a href="#" class=" dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <div class="user-avatar">
                        <!-- <img src="#" alt="..."> -->
                    </div>
                    <span class="hidden-sm hidden-xs">{{ Auth::user()->name }}</span>
                    <!--<i class="fa fa-angle-down"></i>-->
                    <span class="caret hidden-sm hidden-xs"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                    <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form></li>
                </ul>
            </li>

             
        </ul>
        <!--notification end-->

    </div>

</header>
<!--header end-->