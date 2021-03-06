@extends("admin.layout.main")
@section("title")
    实时湿度
@endsection

@section("content")
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                实时数据
                <small>湿度（刷新间隔:2秒）</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div id="humidity" style="min-width:400px;height:400px"></div>

                </div>
                <!-- /.col -->
            </div>


            <!-- /.row -->

        </section>
        <!-- /.content -->
@endsection


@section("page script")
    <script src="../../highcharts/highcharts.js"></script>
    <script src="../../js/charts/realTimeHumidity.js"></script>
@endsection