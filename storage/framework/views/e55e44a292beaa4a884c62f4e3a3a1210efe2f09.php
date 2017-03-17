<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link rel="stylesheet" href="<?php echo asset('css/vendor.css'); ?>" />
    <link rel="stylesheet" href="<?php echo asset('css/app.css'); ?>" />
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <h2>庄远国际-后台管理系统</h2>
            <form class="m-t" role="form" action="<?php echo url('auth/login');?>" method="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>"/>
                <div class="form-group">
<<<<<<< HEAD
                    <input type="text" name="email" class="form-control" placeholder="邮箱" required="">
=======
                    <input type="text" name="user_name" class="form-control" placeholder="手机或者邮箱" required="">
>>>>>>> 40d71934e8efdd692ca4a39832f230f02c0c32be
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="密码" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            </form>
            <p class="m-t"> <small>庄远国际 &copy; 2017</small> </p>
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="<?php echo asset('js/app.js'); ?>" type="text/javascript"></script>
</body>

</html>
