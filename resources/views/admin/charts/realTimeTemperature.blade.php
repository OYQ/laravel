@extends("admin.layout.main")


@section("content")
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Flot Charts
                <small>preview sample</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Charts</a></li>
                <li class="active">Flot</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div id="temperature" style="min-width:400px;height:400px"></div>

                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-xs-12">

                    {{--<div id="humidity" style="min-width:400px;height:400px"></div>--}}

                </div>
                <!-- /.col -->
            </div>

            <!-- /.row -->

            <div class="row">
                <div class="col-md-6">
                    col-md-6
                </div>
                <div class="col-md-6">
                    col-md-6

                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection


@section("page script")

    <script src="../../highcharts/highcharts.js"></script>
    <script src="../../js/charts/realTimeTemperature.js"></script>
    {{--<script src="../../js/charts/realTimeHumidity.js"></script>--}}
@endsection