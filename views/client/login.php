<?php 
require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
$title = 'ĐĂNG NHẬP | '.$CMSNT->site('title');
$header = '';
require_once __DIR__.'/header.php';

?>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="<?=BASE_URL('');?>">
                    <img src="<?=BASE_URL($CMSNT->site('logo_light'));?>" alt="">
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="<?=BASE_URL('Auth/Register');?>">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?=BASE_URL($CMSNT->site('bg_login'));?>" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Đăng Nhập</h2>
                        </div>
                        <form>
                            <div class="input-group custom">
                                <input type="text" id="username" class="form-control form-control-lg"
                                    placeholder="Nhập tên đăng nhập">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" id="password" class="form-control form-control-lg"
                                    placeholder="Nhập mật khẩu">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Lưu mật khẩu</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password"><a href="<?=BASE_URL('Auth/ForgotPassword');?>">Quên mật khẩu</a></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button class="btn btn-primary btn-lg btn-block" type="button"
                                            id="btnLogin">Đăng Nhập</button>
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">hoặc
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block" href="<?=BASE_URL('Auth/Register');?>">Tạo Tài
                                            Khoản Mới</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $("#btnLogin").on("click", function() {
        $('#btnLogin').html('Đang xử lý').prop('disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/client/auth.php");?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: 'Login',
                username: $("#username").val(),
                password: $("#password").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    cuteToast({
                        type: "success",
                        message: respone.msg,
                        timer: 5000
                    });
                    location.href = "<?=BASE_URL('views/client/');?>";
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#btnLogin').html('Đăng Nhập').prop('disabled', false);
            },
            error: function() {
                alert(html(response));
                location.reload();
            }

        });
    });
    </script>
    <!-- js -->
    <script src="<?=BASE_URL('template/DeskApp/');?>vendors/scripts/core.js"></script>
    <script src="<?=BASE_URL('template/DeskApp/');?>vendors/scripts/script.min.js"></script>
    <script src="<?=BASE_URL('template/DeskApp/');?>vendors/scripts/process.js"></script>
    <script src="<?=BASE_URL('template/DeskApp/');?>vendors/scripts/layout-settings.js"></script>
</body>

</html>