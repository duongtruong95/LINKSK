<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Chỉnh sửa chiến dịch | '.$CMSNT->site('title');
$header = '
';
$footer = '
';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';

if(isset($_GET['id']))
{
    $id = check_string($_GET['id']);
    if(!$row = $CMSNT->get_row("SELECT * FROM `campaigns` WHERE `id` = '$id' AND `user_id` = '".$getUser['id']."'  "))
    {
        die('404 - Trang không tồn tại !');
    }
}
else
{
    die('404 - Trang không tồn tại !');
}

if(isset($_POST['save']))
{
    if($getUser['expired'] <= 0)
    {
        msg_error("Bạn cần nâng cấp tài khoản mới có thể sử dụng chức năng này.", BASE_URL('package'), 2000);
    }
    $isAdd = $CMSNT->update("campaigns", [
        'name'      => check_string($_POST['name']),
        'url_1'     => check_string($_POST['url_1']),
        'url_2'     => check_string($_POST['url_2']),
        'block_desktop'     => check_string($_POST['block_desktop']),
        'updatedate'=> gettime(),
        'status'    => check_string($_POST['status'])
    ], " `id` = '$id' ");
    if($isAdd)
    {
        msg_success('Lưu chiến dịch thành công !', "", 1000);
    }
    else
    {
        msg_error('Lưu chiến dịch thất bại !', '', 2000);
    }
}
?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Chỉnh sửa chiến dịch</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('service/campaign');?>">Bọc link VPCS</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa chiến dịch</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <h4 class="text-blue text-center h4">LƯU Ý</h4>
                <?=$CMSNT->site('boclink_notice');?>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">EDIT CHIẾN DỊCH #<?=$row['id'];?></h4>
                        <p class="mb-30">Nhập thông tin cần chỉnh sửa bên dưới</p>
                    </div>
                    <div class="pull-right">
                        <a href="<?=BASE_URL('service/campaign');?>" class="btn btn-primary btn-sm scroll-click"><i
                                class="icon-copy fa fa-mail-reply mr-1" aria-hidden="true"></i>QUAY LẠI</a>
                    </div>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tên chiến dịch</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="name"
                                placeholder="Nhập tên chiến dịch cần tạo" value="<?=$row['name'];?>" required>
                            <small class="form-text text-muted">Nên đặt tên dễ nhớ để dễ quản lý.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">URL 1</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="url" class="form-control" name="url_1"
                                placeholder="Nhập link sạch cần chạy quảng cáo " value="<?=$row['url_1'];?>" required>
                            <small class="form-text text-muted">Đây là link mà robot thu thập thông tin và người kiểm
                                duyệt sẽ nhìn thấy.</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">URL 2</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="url" class="form-control" name="url_2" value="<?=$row['url_2'];?>"
                                placeholder="Nhập link web thật cần chuyển tới" required>
                            <small class="form-text text-muted">Khách hàng thật sẽ được tự động chuyển đến link
                                này.(link bán hàng)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="status" required>
                                <option <?=$row['status'] == '0' ? 'selected' : '';?> value="0">ON</option>
                                <option <?=$row['status'] == '1' ? 'selected' : '';?> value="1">OFF</option>
                            </select>
                            <small class="form-text text-muted">Nếu trạng thái ON, người dùng truy cập sẽ chuyển hướng về URL 2(link bán hàng).</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Chặn desktop</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="block_desktop" required>
                                <option <?=$row['block_desktop'] == '1' ? 'selected' : '';?> value="1">ON</option>
                                <option <?=$row['block_desktop'] == '0' ? 'selected' : '';?> value="0">OFF</option>
                            </select>
                            <small class="form-text text-muted">Nếu bật ON chặn desktop, người dùng truy cập bằng máy tính sẽ luôn ở lại link sạch.(Dùng mobile và PC nên để OFF)</small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Thời gian tạo</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?=$row['createdate'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Thời gian cập nhật</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?=$row['updatedate'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Lượt xem</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?=$row['views'];?>" readonly>
                        </div>
                    </div>
                    <button class="btn btn-primary" name="save" type="submit"><i class="icon-copy fa fa-save mr-1"
                            aria-hidden="true"></i>Lưu Ngay</button>
                </form>
            </div>
            <!-- Default Basic Forms End -->
        </div>
        <?php
require_once __DIR__.'/footer.php';
?>