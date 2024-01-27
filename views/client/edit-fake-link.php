<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Chỉnh sửa link | '.$CMSNT->site('title');
$header = '
';
$footer = '
';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';

if(isset($_GET['id']))
{
    $id = check_string($_GET['id']);
    if(!$row = $CMSNT->get_row("SELECT * FROM `links` WHERE `id` = '$id' AND `user_id` = '".$getUser['id']."'  "))
    {
        die('404 - Trang không tồn tại !');
    }
}
else
{
    die('404 - Trang không tồn tại !');
}
if(isset($_POST['AddDomain']))
{
    if($CMSNT->get_row("SELECT * FROM `domains` WHERE `domain` = '".check_string($_POST['domain'])."' ")){
        die('<script type="text/javascript">if(!alert("Tên miền này đã tồn tại trong hệ thống.")){window.history.back().location.reload();}</script>');
    }
    $isCreate = $CMSNT->insert("domains", [
        'user_id'   => $getUser['id'],
        'domain'    => check_string($_POST['domain']),
        'share'     => isset($_POST['share']) ? check_string($_POST['share']) : 0,
        'status'    => 0,
        'createdate'    => gettime(),
        'updatedate'    => gettime()
    ]);
    if($isCreate)
    {
        msg_success("Thêm tên miền thành công, vui lòng đợi Admin duyệt!", "", 3000);
    }
    else
    {
        die('<script type="text/javascript">if(!alert("Thêm tên miền thất bại, vui lòng thử lại!")){window.history.back().location.reload();}</script>');
    }
}
if(isset($_POST['save']))
{
    if($getUser['expired'] <= 0)
    {
        msg_error("Bạn cần nâng cấp tài khoản mới có thể sử dụng chức năng này.", BASE_URL('package'), 2000);
    }
    $title = check_string($_POST['title']);
    $description = check_string($_POST['description']);
    $url_href = check_string($_POST['url_href']);
    $status = check_string($_POST['status']);
    $domain = check_string($_POST['domain']);

    if(check_img('url_img') == true)
    {
        $uploads_dir = '../../assets/storage/images';
        $tmp_name = $_FILES['url_img']['tmp_name'];
        $url_img = "/flink_".random('1234567890', 5).".png";
        move_uploaded_file($tmp_name, $uploads_dir.$url_img);
        $CMSNT->update('links', [
            'url_img'       => 'assets/storage/images'.$url_img
        ], " `id` = '$id' ");
    }
    $isUpdate = $CMSNT->update('links', [
        'title'         => $title,
        'description'   => $description,
        'url_href'      => $url_href,
        'domain'        => $domain,
        'status'        => $status,
        'updatedate'    => gettime()
    ], " `id` = '$id' ");
    if($isUpdate)
    {
        msg_success('Lưu thành công!', "", 1000);
    }
    else
    {
        msg_error("Lưu thất bại", "", 2000);
    }
}
?>
<div class="modal fade bs-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Thêm tên miền</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Domain</label>
                            <div class="col-sm-12 col-md-10">
                                <input type="text" class="form-control"
                                    placeholder="Nhập tên miền mới của bạn, VD: https://cmsnt.co/" name="domain"
                                    required>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="share" value="1" id="share">
                            <label for="share" class="custom-control-label">Chia sẽ tên miền này cho mọi
                                người</label>
                        </div>
                        <br>
                        <i>Tất cả thành viên trả phí đều có thể sử dụng domain này nếu bạn tích vào ô 'Chia sẽ tên miền
                            này cho mọi
                            người'</i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="submit" name="AddDomain" class="btn btn-primary">Thêm Ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Chỉnh sửa link</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('service/fake-link');?>">Fake link</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Chỉnh sửa link</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <h4 class="text-blue text-center h4">LƯU Ý</h4>
                <?=$CMSNT->site('fakelink_notice');?>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">EDIT LINK #<?=$row['id'];?></h4>
                        <p class="mb-30">Nhập thông tin cần chỉnh sửa bên dưới</p>
                    </div>
                    <div class="pull-right">
                        <a href="<?=BASE_URL('service/fake-link');?>" class="btn btn-primary btn-sm scroll-click"><i
                                class="icon-copy fa fa-mail-reply mr-1" aria-hidden="true"></i>QUAY LẠI</a>
                    </div>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Tiêu đề fake</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" name="title" value="<?=$row['title'];?>"
                                placeholder="Nhập tiêu đề link" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Mô tả fake</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?=$row['description'];?>" name="description"
                                placeholder="Nhập mô tả link nếu có">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Ảnh cần fake</label>
                        <div class="col-sm-12 col-md-10">
                            <input type="file" class="form-control-file form-control height-auto" name="url_img">
                            <img src="<?=BASE_URL($row['url_img']);?>" width="100%" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Chọn tên miền (<a href="#" data-toggle="modal"
                                data-target="#bd-example-modal-lg">Thêm tên miền mới</a>)</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="domain" required>
                                <?php foreach($CMSNT->get_list("SELECT * FROM `domains` WHERE `user_id` = '".$getUser['id']."' OR `share` = '1' AND `status` = '1' ") as $domain){?>
                                <option value="<?=$domain['domain'];?>" <?=$row['domain'] == $domain['domain'] ? 'selected' : '';?>><?=$domain['domain'];?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Link thật cần chuyển tới</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="url" value="<?=$row['url_href'];?>" name="url_href"
                                placeholder="Nhập link gốc cần chuyển tới" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Link fake</label>
                        <div class="col-sm-12 col-md-10">
                            <input class="form-control" type="text" value="<?=$row['domain'].'/'.$row['url_fake'];?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-md-2 col-form-label">Trạng thái</label>
                        <div class="col-sm-12 col-md-10">
                            <select class="custom-select col-12" name="status" required>
                                <option <?=$row['status'] == '1' ? 'selected' : '';?> value="1">ON</option>
                                <option <?=$row['status'] == '0' ? 'selected' : '';?> value="0">OFF</option>
                            </select>
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
                            <input class="form-control" type="text" value="<?=$CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '".$row['id']."'  ");?>" readonly>
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