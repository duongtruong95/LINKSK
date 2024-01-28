<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Thống kê truy cập chiến dịch | '.$CMSNT->site('title');
$header = '
<link rel="stylesheet" type="text/css" href="'.BASE_URL('template/DeskApp/').'src/plugins/jvectormap/jquery-jvectormap-2.0.3.css">
';
$footer = '
<script src="'.BASE_URL('template/DeskApp/').'src/plugins/jQuery-Knob-master/jquery.knob.min.js"></script>
<script src="'.BASE_URL('template/DeskApp/').'src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="'.BASE_URL('template/DeskApp/').'src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
<script src="'.BASE_URL('template/DeskApp/').'src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="'.BASE_URL('template/DeskApp/').'src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
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
    $isAdd = $CMSNT->update("campaigns", [
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
                            <h4>Thống kê truy cập</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('service/campaign');?>">Bọc link
                                        VPCS</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Thống kê truy cập</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                    <?php
                        $total = $CMSNT->num_rows("SELECT * FROM `campaign_views` WHERE `campaign_id` = '$id' ");
                        if($total > 0)
                        {
                            $chrome = $CMSNT->num_rows("SELECT * FROM `campaign_views` WHERE `campaign_id` = '$id' AND `browser` = 'Google Chrome' ") / $total * 100;
                            $firefox = $CMSNT->num_rows("SELECT * FROM `campaign_views` WHERE `campaign_id` = '$id' AND `browser` = 'Mozilla Firefox' ") / $total * 100;
                            $saferi = $CMSNT->num_rows("SELECT * FROM `campaign_views` WHERE `campaign_id` = '$id' AND `browser` = 'Apple Safari' ") / $total * 100;
                            $explorer = $CMSNT->num_rows("SELECT * FROM `campaign_views` WHERE `campaign_id` = '$id' AND `browser` = 'Internet Explorer' ") / $total * 100;
                            $opera = $CMSNT->num_rows("SELECT * FROM `campaign_views` WHERE `campaign_id` = '$id' AND `browser` = 'Opera' ") / $total * 100;
                        }
                        else{
                            $chrome = 0;
                            $firefox = 0;
                            $saferi = 0;
                            $explorer = 0;
                            $opera = 0;
                        }
                    ?>
                    <div class="card-box pd-30 pt-10 height-100-p">
                        <h2 class="mb-30 h4">TRÌNH DUYỆT</h2>
                        <div class="browser-visits">
                            <ul>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img
                                            src="<?=BASE_URL('template/DeskApp/');?>vendors/images/chrome.png" alt="">
                                    </div>
                                    <div class="browser-name">Google Chrome</div>
                                    <div class="visit"><span
                                            class="badge badge-pill badge-primary"><?=explode('.', $chrome)[0];?>%</span>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img
                                            src="<?=BASE_URL('template/DeskApp/');?>vendors/images/firefox.png" alt="">
                                    </div>
                                    <div class="browser-name">Mozilla Firefox</div>
                                    <div class="visit"><span
                                            class="badge badge-pill badge-secondary"><?=explode('.', $firefox)[0];?>%</span>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img
                                            src="<?=BASE_URL('template/DeskApp/');?>vendors/images/safari.png" alt="">
                                    </div>
                                    <div class="browser-name">Safari</div>
                                    <div class="visit"><span
                                            class="badge badge-pill badge-success"><?=explode('.', $saferi)[0];?>%</span>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img
                                            src="<?=BASE_URL('template/DeskApp/');?>vendors/images/edge.png" alt="">
                                    </div>
                                    <div class="browser-name">Microsoft Edge</div>
                                    <div class="visit"><span
                                            class="badge badge-pill badge-warning"><?=explode('.', $explorer)[0];?>%</span>
                                    </div>
                                </li>
                                <li class="d-flex flex-wrap align-items-center">
                                    <div class="icon"><img
                                            src="<?=BASE_URL('template/DeskApp/');?>vendors/images/opera.png" alt="">
                                    </div>
                                    <div class="browser-name">Opera Mini</div>
                                    <div class="visit"><span
                                            class="badge badge-pill badge-info"><?=explode('.', $opera)[0];?>%</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6 col-sm-12 mb-30">
                    <div class="card-box pd-30 pt-10 height-100-p">
                        <h2 class="mb-30 h4">CHI TIẾT</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Hãy copy đoạn mã dưới và dán vào cuối web trong link sạch <b
                                        style="color: blue;"><?=$row['url_1'];?></b> của bạn. Hoặc mục <b
                                        style="color: red;">Mã Javascript/CSS</b> nếu bạn dùng Ladipage.</label>
                                <textarea class="form-control copy" style="color: #0bc134;background:#000000;"
                                    data-clipboard-target="#copyJS" id="copyJS" readonly>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="<?=BASE_URL('libary.js?v='.$row['trans_id']);?>"></script></textarea>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">URL 1</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="url" class="form-control" name="url_1"
                                        placeholder="Nhập link sạch cần chạy quảng cáo " value="<?=$row['url_1'];?>"
                                        readonly>
                                    <small class="form-text text-muted">Đây là link mà robot thu thập thông tin và người
                                        kiểm
                                        duyệt sẽ nhìn thấy.</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">URL 2</label>
                                <div class="col-sm-12 col-md-10">
                                    <input type="url" class="form-control" name="url_2" value="<?=$row['url_2'];?>"
                                        placeholder="Nhập link web thật cần chuyển tới" readonly>
                                    <small class="form-text text-muted">Khách hàng thật sẽ được tự động chuyển đến link
                                        này.</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Trạng thái</label>
                                <div class="col-sm-12 col-md-10">
                                    <select class="custom-select col-12" name="status" required>
                                        <option <?=$row['status'] == '0' ? 'selected' : '';?> value="0">ON</option>
                                        <option <?=$row['status'] == '1' ? 'selected' : '';?> value="1">OFF</option>
                                    </select>
                                    <small class="form-text text-muted">Nếu trạng thái ON, người dùng truy cập sẽ
                                        chuyển hướng
                                        về <b style="color: red;"><?=$row['url_2'];?></b></small>
                                </div>
                            </div>
                            <button class="btn btn-primary" name="save" type="submit"><i
                                    class="icon-copy fa fa-save mr-1" aria-hidden="true"></i>Lưu Ngay</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">DANH SÁCH TRUY CẬP</h4>
                        <p class="mb-30">Thống kê truy cập thông qua chiến dịch #<?=$row['trans_id'];?></p>
                    </div>
                    <div class="pull-right">
                        <a href="<?=BASE_URL('service/campaign');?>" class="btn btn-primary btn-sm scroll-click"><i
                                class="icon-copy fa fa-mail-reply mr-1" aria-hidden="true"></i>QUAY LẠI</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table hover stripe  multiple-select-row data-table-export nowrap ">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">#</th>
                                <th>Country</th>
                                <th>Device</th>
                                <th>Browser</th>
                                <th>IP</th>
                                <th>UserAgent</th>
                                <th>Redirect</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach($CMSNT->get_list("SELECT * FROM `campaign_views` WHERE `campaign_id` = '$id' ORDER BY `id` DESC ") as $row){?>
                            <tr>
                                <td class="table-plus"><?=$i++;?></td>
                                <td><img src="<?=BASE_URL('template/flag/'.$row['country']);?>.svg" width="30px"></td>
                                <td><img src="<?=BASE_URL('assets/img/'.$row['device']);?>.png" width="25px"></td>
                                <td><img src="<?=BASE_URL('assets/img/'.$row['browser']);?>.png" width="25px"></td>
                                <td><?=$row['ip'];?></td>
                                <td><?=$row['UserAgent'];?></td>
                                <td><?=$row['redirect'];?></td>
                                <td><span class="badge badge-dark"><?=$row['createdate'];?></span></td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Default Basic Forms End -->
        </div>
        <?php
require_once __DIR__.'/footer.php';
?>