var table;
$(document).ready(function() {
    table = $('#dataTable').DataTable( {
        //开启服务器模式
        serverSide: true,
        searching:false,
        ordering:false,
        //数据来源（包括处理分页，排序，过滤） ，即url，action，接口，等等
        ajax: '/admin/alertInfo',
        "columns": [
            { "data": "temperature" },
            { "data": "humidity" },
            { "data": "lightIntensity" },
            { "data": "soilMoisture" },
            { "data": "rainfall" },
            { "data": "time" }
        ],
        language: {
            "sProcessing": "处理中...",
            "sLengthMenu": "显示 _MENU_ 项结果",
            "sZeroRecords": "没有匹配结果",
            "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
            "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
            "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
            "sInfoPostFix": "",
            "sSearch": "搜索:",
            "sUrl": "",
            "sEmptyTable": "表中数据为空",
            "sLoadingRecords": "载入中...",
            "sInfoThousands": ",",
            "oPaginate": {
                "sFirst": "首页",
                "sPrevious": "上页",
                "sNext": "下页",
                "sLast": "末页"
            },
            "oAria": {
                "sSortAscending": ": 以升序排列此列",
                "sSortDescending": ": 以降序排列此列"
            }
        },
        "pagingType":   "full_numbers"
    } );

    $('#dataTable tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

    $('#deleteBtn').click( function () {
        // console.log(table.rows('.selected').data());
        // table.row('.selected').remove().draw( false );
        deleteData(table.rows('.selected').data()[0].alertid);

    } );
} );

function deleteData(id) {
    $.getJSON('/admin/deleteAlertInfo?id='+id ,function (Jsondata) {
        if (Jsondata.error == 0){
            table.row('.selected').remove().draw( false );
        }else {
            alert(Jsondata.msg);
        }
    });
}