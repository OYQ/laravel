@extends("admin.layout.main")
@section("title")
    均值统计
@endsection
@section("link")
    <link rel="stylesheet" type="text/css" href="../../css/chart/meanData.css">
    <link rel="stylesheet" href="../../adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../adminlte/plugins/select2/select2.min.css">
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            图表统计
            <small>均值统计</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="input-group" id="dataRangePicker">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservationtime">
                </div>
            </div>

            <div class="col-md-6">
                <div class="btn-group">
                    <button type="button" class="btn btn-default" id="hour">小时平均</button>
                    <button type="button" class="btn btn-default" id="day">日平均</button>
                    <button type="button" class="btn btn-default" id="month">月平均</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div id="container" style="min-width:400px;height:400px"></div>

            </div>

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection

@section("page script")
    <script src="../../highcharts/highcharts.js"></script>
    <script src="../../js/charts/meanData.js"></script>

    <script src="../../adminlte/plugins/select2/select2.full.min.js"></script>
    <script src="../../adminlte/dist/js/moment.min.js"></script>
    <script src="../../adminlte/plugins/daterangepicker/daterangepicker.js"></script>
@endsection
