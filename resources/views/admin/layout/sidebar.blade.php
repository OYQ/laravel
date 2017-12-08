<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">


        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">导航栏</li>
            <li class="active">
                <a href="/admin/dashboard">
                    <i class="fa fa-dashboard"></i> <span>仪表盘</span>

                </a>
            </li>


            <li class="active">
                <a href="/admin/chartStatistics">
                    <i class="fa fa-pie-chart"></i> <span>图表统计</span>

                </a>
            </li>

            {{--<li class="active">--}}
                {{--<a href="/admin/chartRealTime">--}}
                    {{--<i class="fa  fa-desktop"></i> <span>实时数据</span>--}}

                {{--</a>--}}
            {{--</li>--}}

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-desktop"></i>
                    <span>实时数据</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/chartRealTime/temperature"><i class="fa fa-circle-o"></i>温度数据</a></li>
                    <li><a href="/admin/chartRealTime/humidity"><i class="fa fa-circle-o"></i>湿度数据</a></li>
                </ul>
            </li>

            <li class="active">
                <a href="/admin/dataTable">
                    <i class="fa fa-bar-chart"></i> <span>详细数据</span>

                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>