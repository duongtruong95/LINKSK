<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Profile | '.$CMSNT->site('title');
$header = '
';
$footer = '
';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';

if(isset($_POST['save']))
{
    $CMSNT->update("users", [
        'full_name' => check_string($_POST['full_name']),
        'email' => check_string($_POST['email']),
        'birthday'  => check_string($_POST['birthday']),
        'gender'    => check_string($_POST['gender']),
        'phone'    => check_string($_POST['phone'])
    ], " `id` = '".$getUser['id']."' ");
    msg_success("Cập nhật thông tin thành công!", "", 1000);
}
?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Thông Tin Chi Tiết</h5>
                            <ul>
                                <li>
                                    <span>Tên Đăng Nhập:</span>
                                    <?=$getUser['username'];?>
                                </li>
                                <li>
                                    <span>Địa Chỉ Email:</span>
                                    <?=$getUser['email'];?>
                                </li>
                                <li>
                                    <span>Số Điện Thoại:</span>
                                    <?=$getUser['phone'];?>
                                </li>
                                <li>
                                    <span>Họ Và Tên:</span>
                                    <?=$getUser['full_name'];?>
                                </li>
                                <li>
                                    <span>Giới Tính:</span>
                                    <?=$getUser['gender'];?>
                                </li>
                                <li>
                                    <span>Số Dư:</span>
                                    <?=format_currency($getUser['money']);?>
                                </li>
                                <li>
                                    <span>Tổng Nạp:</span>
                                    <?=format_currency($getUser['total_money']);?>
                                </li>
                                <li>
                                    <span>Chi Tiêu:</span>
                                    <?=format_currency($getUser['total_money']-$getUser['money']);?>
                                </li>
                                <li>
                                    <span>Hạn Sử Dụng:</span>
                                    <?=format_cash($getUser['expired']);?> ngày
                                </li>
                                <li>
                                    <span>Thời Gian Đăng Ký:</span>
                                    <?=$getUser['createdate'];?>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#dongtien" role="tab">NHẬT KÝ
                                            DÒNG TIỀN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#setting" role="tab">CÀI ĐẶT THÔNG
                                            TIN</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#changepassword" role="tab">THAY ĐỔI
                                            MẬT KHẨU</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- Timeline Tab start -->
                                    <div class="tab-pane fade show active" id="dongtien" role="tabpanel">
                                        <div class="pd-20 mb-30">
                                            <div class="table-responsive">
                                                <table
                                                    class="table hover multiple-select-row data-table-export nowrap ">
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
                                    foreach($CMSNT->get_list(" SELECT * FROM `dongtien` WHERE `user_id` = '".$getUser['id']."'  ORDER BY id DESC  ") as $row){
                                    ?>
                                                        <tr>
                                                            <td><?=$i++;?></td>
                                                            <td><b
                                                                    style="color: blue;"><?=format_cash($row['sotientruoc']);?></b>
                                                            </td>
                                                            <td><b
                                                                    style="color: red;"><?=format_cash($row['sotienthaydoi']);?></b>
                                                            </td>
                                                            <td><b
                                                                    style="color: green;"><?=format_cash($row['sotiensau']);?></b>
                                                            </td>
                                                            <td><span
                                                                    class="badge badge-dark"><?=$row['thoigian'];?></span>
                                                            </td>
                                                            <td><?=$row['noidung'];?></td>
                                                        </tr>
                                                        <?php }?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>SỐ TIỀN TRƯỚC</th>
                                                            <th>SỐ TIỀN THAY ĐỔI</th>
                                                            <th>SỐ TIỀN HIỆN TẠI</th>
                                                            <th>THỜI GIAN</th>
                                                            <th>NỘI DUNG</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Timeline Tab End -->
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p" id="setting" role="tabpanel">
                                        <div class="profile-setting">
                                            <form action="" method="POST">
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">Chỉnh sửa thông tin cá nhân của
                                                            bạn</h4>
                                                        <div class="form-group">
                                                            <label>Họ và Tên</label>
                                                            <input class="form-control form-control-lg" name="full_name"
                                                                value="<?=$getUser['full_name'];?>" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control form-control-lg" name="email"
                                                                value="<?=$getUser['email'];?>" type="email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            <input class="form-control form-control-lg" name="phone"
                                                                value="<?=$getUser['phone'];?>" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Birthday</label>
                                                            <input class="form-control form-control-lg date-picker"
                                                                value="<?=$getUser['birthday'];?>" name="birthday"
                                                                type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Giới Tính</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="customRadio4" name="gender"
                                                                        value="Male" class="custom-control-input"
                                                                        <?=$getUser['gender'] == 'Male' ? 'checked' : '';?>>
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio4">Nam</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio5" name="gender"
                                                                        value="Female"
                                                                        <?=$getUser['gender'] == 'Female' ? 'checked' : '';?>
                                                                        class="custom-control-input">
                                                                    <label class="custom-control-label weight-400"
                                                                        for="customRadio5">Nữ</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="submit" name="save" class="btn btn-primary"
                                                                value="Cập nhật thông tin">
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                    <!-- Setting Tab start -->
                                    <div class="tab-pane fade height-100-p" id="changepassword" role="tabpanel">
                                        <div class="profile-setting">
                                            <form action="" method="POST">
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">Nhập thông tin để thay đổi mật
                                                            khẩu mới</h4>
                                                        <div class="form-group">
                                                            <label>Mật khẩu hiện tại</label>
                                                            <input class="form-control form-control-lg" id="password"
                                                                type="password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Mật khẩu mới</label>
                                                            <input class="form-control form-control-lg" id="newpassword"
                                                                type="password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nhập lại mật khẩu mới</label>
                                                            <input class="form-control form-control-lg"
                                                                id="renewpassword" type="password">
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="button" id="ChangePassword"
                                                                class="btn btn-primary" value="Đổi mật khẩu ngay">
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                        <script type="text/javascript">
                                        $("#ChangePassword").on("click", function() {
                                            $('#ChangePassword').html('Đang xử lý').prop('disabled',
                                                true);
                                            $.ajax({
                                                url: "<?=BASE_URL("assets/ajaxs/client/auth.php");?>",
                                                method: "POST",
                                                dataType: "JSON",
                                                data: {
                                                    action: 'ChangePassword',
                                                    password: $("#password").val(),
                                                    newpassword: $("#newpassword").val(),
                                                    renewpassword: $("#renewpassword").val()
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
                                                    $('#ChangePassword').html('Đổi mật khẩu ngay')
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
                                    </div>
                                    <!-- Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
require_once __DIR__.'/footer.php';
?>