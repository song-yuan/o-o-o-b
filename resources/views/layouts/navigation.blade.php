<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">Example user</strong>
                            </span> <span class="text-muted text-xs block">Example menu <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="#">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ isActiveRoute('main') }}">
                <a href="{{ url('/') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Main view</span></a>
            </li>
            <li class="{{ isActiveRoute('partner') }}">
                <a href="{{ url('/partner') }}"><i class="fa fa-th-large"></i> <span class="nav-label">合作伙伴</span> </a>
            </li>
            <li class="{{ isActiveRoute('bill') }}">
                <a href="{{ url('/bill') }}"><i class="fa fa-th-large"></i> <span class="nav-label">快递单</span> </a>
            </li>
            
            <li class="active">
                <a href="#">
                    <i class="fa fa-edit"></i> 
                    <span class="nav-label">文章管理</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="nav nav-second-level collapse in">
                    <li class="active">
                        <a href="{{ url('/category') }}"><span class="nav-label">文章分类</span> </a>
                    </li>
                    <li class="active">
                        <a href="{{ url('/article') }}"><span class="nav-label">文章管理</span> </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
