<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link rel="stylesheet" href="{!! asset('css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}" />
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h2>test-后台管理系统</h2>
            <form class="m-t" role="form" action="<?php echo url('auth/login');?>" method="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="邮箱" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <p class="m-t"> <small>test &copy; 2017</small> </p>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{!! asset('js/app.js') !!}" type="text/javascript"></script>
</body>

</html>
