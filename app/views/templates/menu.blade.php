<nav class="navbar-default navbar-side" style="padding-top: 20px;" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav nav-menu" id="main-menu">

            <li>
                <a href="{{url('home')}}"
                @if(Request::segment(1)=='home') class="active-menu" @endif>
                <i class="fa fa-fw  fa-desktop"></i> {{trans('nav.menu_home')}}</a>
            </li>
            <li>
                <a href="{{url('patient')}}"
                @if(Request::segment(1)=='patient') class="active-menu" @endif>
                <i class="fa fa-fw  fa-user"></i> {{trans('nav.menu_patient')}}</a>
            </li>
            <li>
                <a href="{{url('referout')}}"
                @if(Request::segment(1)=='referout') class="active-menu" @endif>
                <i class="fa fa-fw  fa-ambulance"></i> {{trans('nav.menu_referout')}}</a>
            </li>
            <li>
                <a href="{{url('referin')}}"
                @if(Request::segment(1)=='referin') class="active-menu" @endif>
                <i class="fa fa-fw  fa-ambulance"></i> {{trans('nav.menu_referin')}}</a>
            </li>

            <li>
                <a href="{{url('immigration')}}"
                @if(Request::segment(1)=='immigration') class="active-menu" @endif>
                <i class="fa fa-fw  fa-ambulance"></i> {{trans('nav.menu_immigration')}}</a>
            </li>
            
			<li class="hide">
                <a href="chart.php"><i class="fa fa-bar-chart-o"></i> Charts</a>
            </li>
            <li class="hide">
                <a href="tab-panel.php"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
            </li>
            
            <li class="hide">
                <a href="table.php"><i class="fa fa-table"></i> Responsive Tables</a>
            </li>
            <li class="hide">
                <a href="form.php"><i class="fa fa-edit"></i> Forms </a>
            </li>


            <li class="hide">
                <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Second Level Link</a>
                    </li>
                    <li>
                        <a href="#">Second Level Link</a>
                    </li>
                    <li>
                        <a href="#">Second Level Link<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Third Level Link</a>
                            </li>
                            <li>
                                <a href="#">Third Level Link</a>
                            </li>
                            <li>
                                <a href="#">Third Level Link</a>
                            </li>

                        </ul>

                    </li>
                </ul>
            </li>
            <li>
                <a href="{{url('home/empty')}}"><i class="fa fa-fw fa-file"></i> Empty Page</a>
            </li>
            <li>
                <a href="{{url('administrator')}}"
                @if(Request::segment(1)=='administrator') class="active-menu" @endif>
                <i class="fa fa-fw fa-user"></i> {{trans('nav.menu_administrator')}}</a>
            </li>
        </ul>
         <ul class="nav nav-menu" id="main-menu">

            <li>
                <a href="#time">
                <p>
                <i class="fa fa-clock-o"></i> Time : {{number_format((microtime(true) - LARAVEL_START), 4)}}s<br/>
                </p></a>

            </li>
            </ul>


    </div>

</nav>