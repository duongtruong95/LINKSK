<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
$title = 'Users | CMSNT Panel';
$header = '
<!-- daterange picker -->
<link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/daterangepicker/daterangepicker.css">
<!-- Select2 -->
<link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
';
$footer = '
<!-- InputMask -->
<script src="'.BASE_URL('template/AdminLTE3/').'plugins/moment/moment.min.js"></script>
<script src="'.BASE_URL('template/AdminLTE3/').'plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Select2 -->
<script src="'.BASE_URL('template/AdminLTE3/').'plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
    $(".select2").select2()
    $(".select2bs4").select2({
        theme: "bootstrap4"
    });
});
</script>
';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';
require_once __DIR__.'/../../includes/checkLicense.php';
?>
<?php
/* SEARCH TABLE USERS */
if(isset($_GET['username'])){
    $username = check_string($_GET['username']);
}
else{
    $username = NULL;
}
if(isset($_GET['email'])){
    $email = check_string($_GET['email']);
}
else{
    $email = NULL;
}
if(isset($_GET['admin'])){
    $admin = check_string($_GET['admin']);
}
else{
    $admin = NULL;
}
if(isset($_GET['ip'])){
    $ip = check_string($_GET['ip']);
}
else{
    $ip = NULL;
}
if(isset($_GET['phone'])){
    $phone = check_string($_GET['phone']);
}
else{
    $phone = NULL;
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-plus mr-1"></i>
                                THÊM THÀNH VIÊN
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên đăng nhập</label>
                                <input type="text" class="form-control" placeholder="Nhập tên đăng nhập" id="username"
                                    placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Địa chỉ Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password"
                                    placeholder="Password">
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <button type="button" id="create" class="btn btn-primary"><i
                                    class="fas fa-plus mr-1"></i>TẠO NGAY</button>
                        </div>
                    </div>
                </section>
                <script type="text/javascript">
                $("#create").on("click", function() {
                    $('#create').html(
                        'Đang Xử Lý'
                    ).prop('disabled',
                        true);
                    $.ajax({
                        url: "<?=BASE_URL("assets/ajaxs/admin/user-add.php");?>",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            username: $("#username").val(),
                            email: $("#email").val(),
                            password: $("#password").val()
                        },
                        success: function(respone) {
                            if (respone.code == 1) {
                                cuteToast({
                                    type: "success",
                                    message: respone.msg,
                                    timer: 5000
                                });
                                location.reload();
                            } else {
                                iqwerty.toast.toast(respone.msg);
                            }
                            $('#create').html(
                                '<i class="fas fa-plus mr-1"></i>TẠO NGAY').prop(
                                'disabled', false);
                        },
                        error: function() {
                            alert(html(response));
                            location.reload();
                        }

                    });
                });
                </script>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <h3 class="card-title">
                                <i class="fas fa-users mr-1"></i>
                                DANH SÁCH THÀNH VIÊN
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-warning btn-sm" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i>
                                </button>
                                <button type="button" class="btn bg-danger btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="row" action="" method="GET">
                                <div class="col-sm-2">
                                    <label>Tên đăng nhập:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="username" placeholder="Tìm bằng tên đăng nhập"
                                            value="<?=isset($_GET['username']) ? $_GET['username'] : '';?>"
                                            class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Địa chỉ Email:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="email"
                                            value="<?=isset($_GET['email']) ? $_GET['email'] : '';?>"
                                            placeholder="Tìm bằng địa chỉ Email" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Số điện thoại:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="phone"
                                            value="<?=isset($_GET['phone']) ? $_GET['phone'] : '';?>"
                                            placeholder="Tìm bằng số điện thoại" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Chức vụ:</label>
                                    <div class="form-group">
                                        <select class="form-control select2bs4" style="width: 100%;" name="admin">
                                            <option value="0" <?=$admin == 0 ? 'selected' : '';?>>Thành Viên</option>
                                            <option value="1" <?=$admin == 1 ? 'selected' : '';?>>Admin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Địa chỉ IP:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="ip" placeholder="Tìm bằng địa chỉ IP"
                                            value="<?=isset($_GET['ip']) ? $_GET['ip'] : '';?>" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                class="fas fa-search"></i>
                                            Search</button>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <a href="<?=BASE_URL('views/admin/users.php');?>"
                                            class="btn btn-danger btn-block"><i class="fas fa-trash-restore-alt"></i>
                                            Reset</a>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive p-0">
                                <table class="table table-head-fixed table-hover table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>USERNAME</th>
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>MONEY</th>
                                            <th>IP</th>
                                            <th>STATUS</th>
                                            <th>FIRST LOGIN</th>
                                            <th>LAST LOGIN</th>
                                            <th>ROLE</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                $sotin1trang = 10;
                                if(isset($_GET['page'])){
                                    $page = intval($_GET['page']);
                                }
                                else{
                                    $page = 1;
                                }
                                $from = ($page - 1) * $sotin1trang;
                                foreach($CMSNT->get_list("SELECT * FROM `users` WHERE 
                                `username` LIKE '%$username%' AND 
                                `email` LIKE '%$email%' AND 
                                `admin` LIKE '%$admin%' AND 
                                `ip` LIKE '%$ip%' AND 
                                `phone` LIKE '%$phone%' 
                                ORDER BY id DESC LIMIT $from,$sotin1trang ") as $user ) { ?>

                                        <tr class="odd gradeX">
                                            <td><?=$user['id'];?></td>
                                            <td><?=$user['username'];?></td>
                                            <td><?=$user['email'];?></td>
                                            <td><?=$user['phone'];?></td>
                                            <td><?=format_cash($user['money']);?></td>
                                            <td><?=$user['ip'];?></td>
                                            <td><?=display_online($user['time_session']);?></td>
                                            <td><?=$user['createdate'];?></td>
                                            <td><?=$user['updatedate'];?></td>
                                            <td><?=display_role($user['admin']);?></td>
                                            <td>
                                                <a aria-label=""
                                                    href="<?=BASE_URL('views/admin/edit-user.php?id='.$user['id']);?>"
                                                    style="color:white;" class="btn btn-info btn-icon-left m-b-10"
                                                    type="button">
                                                    <i class="fas fa-edit mr-1"></i><span class="">Edit</span>
                                                </a>
                                                <a aria-label="" target="_blank"
                                                    href="<?=BASE_URL('includes/login-user-admin.php?id='.$user['id']);?>"
                                                    style="color:white;" class="btn btn-success btn-icon-left m-b-10"
                                                    type="button">
                                                    <i class="fas fa-sign-in-alt mr-1"></i><span class="">Login</span>
                                                </a>
                                                <a aria-label="" style="color:white;" data-id="<?=$user['id'];?>"
                                                    class="delete btn btn-danger btn-icon-left m-b-10" type="button">
                                                    <i class="fas fa-trash-alt mr-1"></i><span class="">Delete</span>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <?php
                            $tong = $CMSNT->num_rows(" SELECT * FROM `users` WHERE 
                            `username` LIKE '%$username%' AND 
                            `email` LIKE '%$email%' AND 
                            `admin` LIKE '%$admin%' AND 
                            `ip` LIKE '%$ip%' AND 
                            `phone` LIKE '%$phone%'
                            ORDER BY id DESC ");
                            if ($tong > $sotin1trang)
                            {
                                echo '<center>' . paginationBoostrap(BASE_URL('').'views/admin/users.php?username='.
                                $username.
                                '&email='.$email.
                                '&admin='.$admin.
                                '&ip='.$ip.
                                '&phone='.$phone.
                                '&', $from, $tong, $sotin1trang) . '</center>';
                            }?>
                        </div>
                    </div>
                </section>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script type="text/javascript">
$(".delete").on("click", function() {
    cuteAlert({
        type: "question",
        title: "Xác Nhận Xóa Thành Viên",
        message: "Bạn có chắc chắn muốn xóa thành viên ID " + $(this).data('id') + " không ?",
        confirmText: "Đồng Ý",
        cancelText: "Hủy"
    }).then((e) => {
        if (e) {
            $.ajax({
                url: "<?=BASE_URL("assets/ajaxs/admin/user-delete.php");?>",
                method: "POST",
                dataType: "JSON",
                data: {
                    id: $(this).data('id')
                },
                success: function(respone) {
                    if (respone.status == 'success') {
                        cuteToast({
                            type: "success",
                            message: respone.msg,
                            timer: 5000
                        });
                        location.reload();
                    } else {
                        cuteAlert({
                            type: "error",
                            title: "Error",
                            message: respone.msg,
                            buttonText: "Okay"
                        });
                    }
                },
                error: function() {
                    alert(html(response));
                    location.reload();
                }
            });
        }
    })
});
</script>


<?php
require_once __DIR__.'/footer.php';
?>