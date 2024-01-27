<?php 
require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
$title = 'ĐĂNG KÝ TÀI KHOẢN | '.$CMSNT->site('title');
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
                    <li><a href="<?=BASE_URL('Auth/Login');?>">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="<?=BASE_URL($CMSNT->site('bg_register'));?>" alt="">
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Tạo Tài Khoản Mới</h2>
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
                                <input type="email" id="email" class="form-control form-control-lg"
                                    placeholder="Nhập địa chỉ email">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-email-1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input type="password" id="password" class="form-control form-control-lg"
                                    placeholder="Nhập mật khẩu">
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button class="btn btn-primary btn-lg btn-block" type="button"
                                            id="btnRegister">Đăng Ký Ngay</button>
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">hoặc
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="<?=BASE_URL('Auth/Login');?>">Đăng Nhập</a>
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
    $("#btnRegister").on("click", function() {
        $('#btnRegister').html('Đang xử lý').prop('disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/client/auth.php");?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: 'Register',
                username: $("#username").val(),
                email: $("#email").val(),
                password: $("#password").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    cuteToast({
                        type: "success",
                        message: respone.msg,
                        timer: 5000
                    });
                    location.href = "<?=BASE_URL('Auth/Login');?>";
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#btnRegister').html('Đăng Ký Ngay').prop('disabled', false);
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