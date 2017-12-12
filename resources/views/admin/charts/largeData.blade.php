@extends("admin.layout.main")


@section("content")
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ChartJS
            <small>Preview sample</small>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
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
    <link rel="stylesheet" type="text/css" href="../../css/chart/largeData.css">
    <script src="../../highcharts/highcharts.js"></script>
    <script src="../../highcharts/modules/boost.js"></script>
    <script src="../../js/charts/chartLargeData.js"></script>

@endsection
