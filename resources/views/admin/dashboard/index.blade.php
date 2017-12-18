@extends("admin.layout.main")
@section("title")
    仪表盘
@endsection


@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 id="temperature">00<sup style="font-size: 20px">%</sup></h3>

                        <p>当前温度</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-thermometer"></i>
                    </div>
                    <a href="/admin/chartRealTime/temperature" class="small-box-footer">实时数据 <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3 id="humidity">00<sup style="font-size: 20px">%</sup></h3>

                        <p>当前湿度</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cloud"></i>
                    </div>
                    <a href="/admin/chartRealTime/humidity" class="small-box-footer">实时数据 <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 id="lightIntensity">00</h3>

                        <p>光照强度</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-sunny-outline"></i>
                    </div>
                    <a href="/admin/chartRealTime/lightIntensity" class="small-box-footer">实时数据 <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 id="soilMoisture">00</h3>

                        <p>土壤湿度</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-waterdrop"></i>
                    </div>
                    <a href="/admin/chartRealTime/soilMoisture" class="small-box-footer">实时数据 <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-8">
                <div id="container" style="min-width:400px;height:400px"></div>
            </div>
            <div class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <i class="fa fa-warning"></i>

                        <h3 class="box-title">环境报警</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my entire
                            soul, like these sweet mornings of spring which I enjoy with my whole heart.
                        </div>

                        <button type="button" class="btn btn-block btn-default">查看详情</button>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">

            天气预报


        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection




@section("page script")
    <!-- ChartJS -->
    {{--<script src="../../adminlte/bower_components/chart.js/Chart.js"></script>--}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{--<script src="../../adminlte/dist/js/pages/dashboard2.js"></script>--}}
    <script src="../../highcharts/highcharts.js"></script>
    <script src="../../js/dashboard/dashboard.js"></script>


@endsection



