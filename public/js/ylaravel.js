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


