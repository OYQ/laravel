@extends("admin.layout.main")

@section("link")
    <link rel="stylesheet" type="text/css" href="../../css/chart/largeData.css">
    <link rel="stylesheet" href="../../adminlte/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../adminlte/plugins/select2/select2.min.css">
@endsection

@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            图表统计
            <small>大数据量统计</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <span id="selectDate">选择日期:</span>

                <div class="input-group" id="dataRangePicker">
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservationtime">
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="temperature">
                <div id="temperature" style="height: 400px; max-width: 800px; margin: 0 auto"></div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="humidity">
                <div id="humidity" style="height: 400px; max-width: 800px; margin: 0 auto"></div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="lightIntensity">

            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="soilMoisture">

            </div>
        </div>

        <div class="row">
            <div class="col-md-12" id="rainfall">

            </div>
        </div>




    </section>
    <!-- /.content -->
@endsection

@section("page script")

    <script src="../../highcharts/highcharts.js"></script>
    <script src="../../highcharts/modules/boost.js"></script>
    <script src="../../js/charts/chartLargeData.js"></script>







    <script src="../../adminlte/plugins/select2/select2.full.min.js"></script>

    <script src="../../adminlte/dist/js/moment.min.js"></script>
    <script src="../../adminlte/plugins/daterangepicker/daterangepicker.js"></script>


@endsection
