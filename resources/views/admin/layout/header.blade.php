<header class="main-header">

    <!-- Logo -->
    <a href="/admin/dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>GE</b>M</span>
        {{--Greenhouses environmental monitoring background--}}
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>环境监测</b>后台</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../../img/avatar.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{\Auth::guard("admin")->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="../../img/avatar.jpg" class="img-circle" alt="User Image">

                            <p>
                                {{\Auth::guard("admin")->user()->name}} - 后台管理员
                                <small>创建于2017年12月</small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="/logout" class="btn btn-default btn-flat">登出</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->

            </ul>
        </div>

    </nav>
</header>