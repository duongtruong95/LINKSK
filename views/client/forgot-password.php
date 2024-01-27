<?php 
require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
$title = 'QUÊN MẬT KHẨU | '.$CMSNT->site('title');
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
                <div class="col-md-6">
                    <img src="<?=BASE_URL('template/DeskApp/');?>vendors/images/forgot-password.png" alt="">
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Quên Mật Khẩu</h2>
                        </div>
                        <h6 class="mb-20">Nhập địa chỉ Email để tìm lại mật khẩu</h6>
                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg" id="email" placeholder="Email">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="fa fa-envelope-o"
                                        aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-5">
                                <div class="input-group mb-0">
                                    <input class="btn btn-primary btn-lg btn-block" type="button" id="ForgotPassword"
                                        value="Submit">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="font-16 weight-600 text-center" data-color="#707373">hoặc</div>
                            </div>
                            <div class="col-5">
                                <div class="input-group mb-0">
                                    <a class="btn btn-outline-primary btn-lg btn-block"
                                        href="<?=BASE_URL('Auth/Login');?>">Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $("#ForgotPassword").on("click", function() {
        $('#ForgotPassword').html('Đang xử lý').prop('disabled',
            true);
        $.ajax({
            url: "<?=BASE_URL("assets/ajaxs/client/auth.php");?>",
            method: "POST",
            dataType: "JSON",
            data: {
                action: 'ForgotPassword',
                email: $("#email").val()
            },
            success: function(respone) {
                if (respone.status == 'success') {
                    cuteToast({
                        type: "success",
                        message: respone.msg,
                        timer: 5000
                    });
                } else {
                    cuteToast({
                        type: "error",
                        message: respone.msg,
                        timer: 5000
                    });
                }
                $('#ForgotPassword').html('Submit').prop('disabled', false);
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