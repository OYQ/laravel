@extends("admin.layout.main")
@section("title")
    详细数据
@endsection

@section("content")

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                详细数据
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">大棚环境详细数据表</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="dataTable" class="stripe" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>温度</th>
                                    <th>湿度</th>
                                    <th>光照强度</th>
                                    <th>土壤湿度</th>
                                    <th>雨量</th>
                                    <th>时间</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>温度</th>
                                    <th>湿度</th>
                                    <th>光照强度</th>
                                    <th>土壤湿度</th>
                                    <th>雨量</th>
                                    <th>时间</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
@endsection

@section("control-sidebar")

@endsection

@section("page script")
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="../../css/table/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/table/table.css">
    <script src="../../adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../../js/table/table.js"></script>



@endsection