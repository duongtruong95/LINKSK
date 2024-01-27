<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Nạp tiền | '.$CMSNT->site('title');
$header = '
';
$footer = '
';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';
?>
<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Nạp tiền</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?=BASE_URL('');?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Nạp tiền</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                <h4 class="text-blue text-center h4">THÔNG BÁO</h4>
                <?=$CMSNT->site('recharge_notice');?>
            </div>
            <div class="row">
                <?php foreach($CMSNT->get_list("SELECT * FROM `banks` ") as $row){?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <h4 class="mb-20 h4"><?=$row['bank_name'];?></h4>
                        <ul class="list-group">
                            <li class="list-group-item">Ngân hàng: <b style="color: green;"><?=$row['bank_name'];?></b>
                            </li>
                            <li class="list-group-item">Số tài khoản: <b data-clipboard-target="#stk<?=$row['id'];?>"
                                    id="stk<?=$row['id'];?>" class="copy"
                                    style="color: blue;"><?=$row['account_number'];?></b></li>
                            <li class="list-group-item">Chủ tài khoản: <b><?=$row['account_name'];?></b></li>
                            <li class="list-group-item">Chi nhánh: <b><?=$row['branch'];?></b></li>
                            <li class="list-group-item">Nội dung chuyển tiền: <b
                                    data-clipboard-target="#content<?=$row['id'];?>" id="content<?=$row['id'];?>"
                                    class="copy"
                                    style="color: red;"><?=$CMSNT->site('recharge_content').$getUser['id'];?></b></li>
                        </ul>
                        <center><img width="250px" src="assets/img/loading.gif"></center>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>

        <?php
require_once __DIR__.'/footer.php';
?>