<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Thống Kê Truy Cập | '.$CMSNT->site('title');
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
    if(!$row = $CMSNT->get_row("SELECT * FROM `links` WHERE `id` = '$id' AND `user_id` = '".$getUser['id']."'  "))
    {
        die('404 - Trang không tồn tại !');
    }
}
else
{
    die('404 - Trang không tồn tại !');
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
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('service/fake-link');?>">Fake link</a>
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
                        $total = $CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '$id' ");
                        if($total > 0)
                        {
                            $chrome = $CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '$id' AND `browser` = 'Google Chrome' ") / $total * 100;
                            $firefox = $CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '$id' AND `browser` = 'Mozilla Firefox' ") / $total * 100;
                            $saferi = $CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '$id' AND `browser` = 'Apple Safari' ") / $total * 100;
                            $explorer = $CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '$id' AND `browser` = 'Internet Explorer' ") / $total * 100;
                            $opera = $CMSNT->num_rows("SELECT * FROM `link_views` WHERE `link_id` = '$id' AND `browser` = 'Opera' ") / $total * 100;
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
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Link thật cần chuyển tới</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="url" value="<?=$row['url_href'];?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-12 col-md-2 col-form-label">Link fake</label>
                            <div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" value="<?=$row['domain'].'i/'.$row['url_fake'];?>"
                                    readonly>
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
                    </div>
                </div>
            </div>
            <!-- Default Basic Forms Start -->
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        <h4 class="text-blue h4">DANH SÁCH TRUY CẬP</h4>
                        <p class="mb-30">Thống kê truy cập thông qua liên kết <a
                                href="<?=$row['domain'].'/'.$row['url_fake'];?>"
                                target="_blank"><?=$row['domain'].'/'.$row['url_fake'];?></a>.</p>
                    </div>
                    <div class="pull-right">
                        <a href="<?=BASE_URL('service/fake-link');?>" class="btn btn-primary btn-sm scroll-click"><i
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
                            <?php $i=0; foreach($CMSNT->get_list("SELECT * FROM `link_views` WHERE `link_id` = '$id' ORDER BY `id` DESC ") as $row){?>
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