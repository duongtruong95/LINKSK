<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login-admin.php';
require_once __DIR__.'/../../class/Mobile_Detect.php';
$title = 'Chỉnh Sửa Thành Viên | CMSNT Panel';
$header = '
    <!-- DataTables -->
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="'.BASE_URL('template/AdminLTE3/').'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
';
$footer = '
    <!-- DataTables  & Plugins -->
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/jszip/jszip.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/pdfmake/pdfmake.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/pdfmake/vfs_fonts.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="'.BASE_URL('template/AdminLTE3/').'plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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

if(isset($_GET['id']))
{
    $id = check_string($_GET['id']);
    $user = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '$id' ");
    if(!$user)
    {
        die('ID user không tồn tại trong hệ thống');
    }
    if(isset($_POST['cong_tien']))
    {
        if($_POST['amount'] <= 0)
        {
            die('<script type="text/javascript">if(!alert("Amount không hợp lệ !")){window.history.back().location.reload();}</script>');
        }
        $amount = check_string($_POST['amount']);
        $reason = check_string($_POST['reason']);
        /* GHI LOG DÒNG TIỀN */
        $CMSNT->insert("dongtien", array(
            'sotientruoc' => getUser($id, 'amount'),
            'sotienthaydoi' => $amount,
            'sotiensau' => getUser($id, 'amount') + $amount,
            'thoigian' => gettime(),
            'noidung' => 'Admin cộng tiền lý do ('.$reason.')',
            'user_id' => $id
        ));
        $CMSNT->cong("users", "money", $amount, " `id` = '$id' ");
        $CMSNT->cong("users", "total_money", $amount, " `id` = '$id' ");
        die('<script type="text/javascript">if(!alert("Cộng tiền thành công !")){window.history.back().location.reload();}</script>');
    }
    if(isset($_POST['tru_tien']))
    {
        if($_POST['amount'] <= 0)
        {
            die('<script type="text/javascript">if(!alert("Amount không hợp lệ !")){window.history.back().location.reload();}</script>');
        }
        $amount = check_string($_POST['amount']);
        $reason = check_string($_POST['reason']);
        /* GHI LOG DÒNG TIỀN */
        $CMSNT->insert("dongtien", array(
            'sotientruoc' => getUser($id, 'amount'),
            'sotienthaydoi' => $amount,
            'sotiensau' => getUser($id, 'amount') - $amount,
            'thoigian' => gettime(),
            'noidung' => 'Admin trừ tiền lý do ('.$reason.')',
            'user_id' => $id
        ));
        $CMSNT->tru("users", "money", $amount, " `id` = '$id' ");
        $CMSNT->cong("users", "used_money", $amount, " `id` = '$id' ");
        die('<script type="text/javascript">if(!alert("Trừ tiền thành công !")){window.history.back().location.reload();}</script>');
    }
}
else
{
    die('ID user không tồn tại trong hệ thống');
}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?=$user['username'];?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/index.php');?>">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?=BASE_URL('views/admin/users.php');?>">Users</a></li>
                        <li class="breadcrumb-item active"><?=$user['username'];?></li>
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
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-edit mr-1"></i>
                                CHỈNH SỬA THÀNH VIÊN
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
                                <label>Tên đăng nhập (*)</label>
                                <input type="hidden" class="form-control" id="id" value="<?=$user['id'];?>">
                                <input type="text" class="form-control" id="username" value="<?=$user['username'];?>">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu (*)</label>
                                <input type="text" class="form-control" value="<?=$user['password'];?>" id="password">
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại (*)</label>
                                <input type="text" class="form-control" value="<?=$user['phone'];?>" id="phone">
                            </div>
                            <div class="form-group">
                                <label>Email (*)</label>
                                <input type="email" class="form-control" value="<?=$user['email'];?>" id="email">
                            </div>
                            <div class="form-group">
                                <label>Gender</label>
                                <input type="text" class="form-control" value="<?=$user['gender'];?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Birthday</label>
                                <input type="text" class="form-control" value="<?=$user['birthday'];?>" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Admin (*)</label>
                                        <select class="form-control select2bs4" id="admin">
                                            <option value="<?=$user['admin'];?>">
                                                <?=$user['admin'] != 1 ? 'OFF' : 'ON';?></option>
                                            <option value="1">ON</option>
                                            <option value="0">OFF</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Banned (*)</label>
                                            <select class="form-control select2bs4" id="banned">
                                                <option value="<?=$user['banned'];?>">
                                                    <?=$user['banned'] != 1 ? 'Live' : 'Banned';?></option>
                                                <option value="1">Banned</option>
                                                <option value="0">Live</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Money (*)</label>
                                        <input type="number" class="form-control" value="<?=$user['money'];?>"
                                            id="money">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Money (*)</label>
                                        <input type="number" class="form-control" value="<?=$user['total_money'];?>"
                                            id="total_money">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Used Money (*)</label>
                                        <input type="number" class="form-control" value="<?=$user['used_money'];?>"
                                            id="used_money">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>IP Login</label>
                                        <input type="text" class="form-control" value="<?=$user['ip'];?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Device Login</label>
                                        <input type="text" class="form-control" value="<?=$user['device'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Login</label>
                                        <input type="text" class="form-control" value="<?=$user['createdate'];?>"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Login</label>
                                        <input type="text" class="form-control" value="<?=$user['updatedate'];?>"
                                            readonly>
                                    </div>
                                </div>
                            </div><br>
                        </div>
                        <div class="card-footer clearfix">
                            <button aria-label="" id="save" class="btn btn-info btn-icon-left m-b-10" type="button"><i
                                    class="fas fa-save mr-1"></i>Lưu Ngay</button>
                        </div>
                    </div>
                    <script type="text/javascript">
                    $("#save").on("click", function() {
                        $('#save').html('Đang xử lý').prop('disabled',
                            true);
                        $.ajax({
                            url: "<?=BASE_URL("assets/ajaxs/admin/user-edit.php");?>",
                            method: "POST",
                            dataType: "JSON",
                            data: {
                                id: $("#id").val(),
                                username: $("#username").val(),
                                password: $("#password").val(),
                                phone: $("#phone").val(),
                                email: $("#email").val(),
                                money: $("#money").val(),
                                admin: $("#admin").val(),
                                banned: $("#banned").val(),
                                total_money: $("#total_money").val(),
                                used_money: $("#used_money").val()
                            },
                            success: function(respone) {
                                if (respone.status == 'success') {
                                    iqwerty.toast.toast(respone.msg);
                                } else {
                                    iqwerty.toast.toast(respone.msg);
                                }
                                $('#save').html(
                                        '<i class="fas fa-save mr-1"></i>Lưu Ngay')
                                    .prop(
                                        'disabled', false);
                            },
                            error: function() {
                                alert(html(response));
                                location.reload();
                            }
                        });
                    });
                    </script>
                </section>
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-success card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-money-bill-alt mr-1"></i>
                                CỘNG TIỀN
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
                            <form class="" action="" method="POST" role="form">
                                <div class="form-group">
                                    <label>Amount (*)</label>
                                    <input type="hidden" class="form-control" id="id" value="<?=$user['id'];?>">
                                    <input type="number" class="form-control" name="amount"
                                        placeholder="Nhập số tiền cần cộng" required>
                                </div>
                                <div class="form-group">
                                    <label>Reason (*)</label>
                                    <textarea class="form-control" name="reason"
                                        placeholder="Nhập nội dung nếu có"></textarea>
                                </div>
                                <br>
                                <button aria-label="" name="cong_tien" class="btn btn-info btn-icon-left m-b-10"
                                    type="submit"><i class="fas fa-paper-plane mr-1"></i>Submit</button>
                            </form>
                        </div>
                    </div>
                </section>
                <section class="col-lg-6 connectedSortable">
                    <div class="card card-danger card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-money-bill-alt mr-1"></i>
                                TRỪ TIỀN
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

                            <form class="" action="" method="POST" role="form">
                                <div class="form-group">
                                    <label>Amount (*)</label>
                                    <input type="hidden" class="form-control" id="id" value="<?=$user['id'];?>">
                                    <input type="number" class="form-control" name="amount"
                                        placeholder="Nhập số tiền cần trừ" required>
                                </div>
                                <div class="form-group">
                                    <label>Reason (*)</label>
                                    <textarea class="form-control" name="reason"
                                        placeholder="Nhập nội dung nếu có"></textarea>
                                </div>
                                <br>
                                <button aria-label="" name="tru_tien" class="btn btn-info btn-icon-left m-b-10"
                                    type="submit"><i class="fas fa-paper-plane mr-1"></i>Submit</button>
                            </form>
                        </div>
                    </div>
                </section>
                <section class="col-lg-12 connectedSortable">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-history mr-1"></i>
                                LỊCH SỬ DÒNG TIỀN
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
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>SỐ TIỀN TRƯỚC</th>
                                            <th>SỐ TIỀN THAY ĐỔI</th>
                                            <th>SỐ TIỀN HIỆN TẠI</th>
                                            <th>THỜI GIAN</th>
                                            <th>NỘI DUNG</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i = 0;
                                    foreach($CMSNT->get_list(" SELECT * FROM `dongtien` WHERE `user_id` = '".$user['id']."' ORDER BY id DESC ") as $row){
                                    ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=format_cash($row['sotientruoc']);?></td>
                                            <td><?=format_cash($row['sotienthaydoi']);?></td>
                                            <td><?=format_cash($row['sotiensau']);?></td>
                                            <td><span class="badge badge-dark"><?=$row['thoigian'];?></span></td>
                                            <td><?=$row['noidung'];?></td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
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



<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example2").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
});
</script>
<?php
    require_once __DIR__.'/footer.php';
?>