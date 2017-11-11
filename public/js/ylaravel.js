$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


var E = window.wangEditor;
var editor = new E('#div1');
var $text1 = $('#content');

//editor.customConfig.debug = true

editor.customConfig.uploadImgServer = '/posts/image/upload';
//在main.blade.php中定义一个csrf-token
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};

editor.customConfig.uploadImgMaxLength = 1;

editor.customConfig.uploadFileName = 'OYQImageUpload';


editor.customConfig.onchange = function (html) {
    // 监控变化，同步更新到 textarea
    $text1.val(html)
};
editor.create();
// 初始化 textarea 的值
$text1.val(editor.txt.html());


$(".like-button").click(function (event) {
    target = $(event.target);
    var current_like = target.attr("like-value");
    var user_id = target.attr("like-user");
    //var _token = target.attr("_token");
    // 已经关注了
    if (current_like == 1) {
        // 取消关注
        $.ajax({
            url: "/user/" + user_id + "/unfan",
            method: "POST",
            //data: {"_token": _token},
            dataType: "json",
            success: function success(data) {
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr("like-value", 0);
                target.text("关注");
            }
        });
    } else {
        // 取消关注
        $.ajax({
            url: "/user/" + user_id + "/fan",
            method: "POST",
            //data: {"_token": _token},
            dataType: "json",
            success: function success(data) {
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr("like-value", 1);
                target.text("取消关注");
            }
        });
    }
});

