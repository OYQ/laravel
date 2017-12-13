
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="../../css/login/login.css">

    <script src="../../js/login/rainyday.min.js"></script>
    <script src="../../js/login/login.js"></script>
    {{--<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>--}}

</head>
<body onload="run();" id="body">
<img id="background" alt="background" src="" />
<div id="container">
    <span class="label label-primary" id="span">大棚环境监测系统</span>

    <form method="post" action="/" class="login">
        {{csrf_field()}}
        <p>
            <label for="login">登录名:</label>
            <input type="text" name="name" id="login" class="form-control" placeholder="名字">
        </p>

        <p>
            <label for="password">密码:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="密码">
        </p>

        <p class="login-submit">
            <button type="submit" class="login-button">Login</button>
        </p>

    </form>


</div>




</body>
</html>
