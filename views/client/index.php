<?php 
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */

require_once __DIR__.'/../../config.php';
require_once __DIR__.'/../../functions/function.php';
require_once __DIR__.'/../../includes/login.php';
//require_once __DIR__.'/../../includes/login-admin.php';

$title = 'Dashbroad | '.$CMSNT->site('title');;
$header = '

';
$footer = '

';
require_once __DIR__.'/header.php';
require_once __DIR__.'/sidebar.php';
?>

<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4 mb-30">
                    <img src="<?=BASE_URL('template/DeskApp/');?>vendors/images/banner-img.png" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Xin Chào Quý Khách <div class="weight-600 font-30 text-blue"><?=$getUser['username'];?>!</div>
                    </h4>
                    <p class="font-18 max-width-600"><?=$CMSNT->site('thongbao');?></p>
                </div>
            </div>
        </div>
        <ul class="row">
            <li class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="product-box">
                    <div class="producct-img"><img src="<?=BASE_URL('');?>assets/img/boclink.png" width="100%"
                            height="100%" alt=""></div>
                    <div class="product-caption">
                        <h4><a href="<?=BASE_URL('service/campaign');?>">BỌC LINK VPCS</a></h4>
                        <div class="price">
                            Giải pháp lên chiến dịch website VPCS hoặc bị Facebook hoặc Google chặn truy cập.
                        </div>
                        <a href="<?=BASE_URL('service/campaign');?>" class="btn btn-outline-primary">Sử Dụng Ngay</a>
                    </div>
                </div>
            </li>
            <li class="col-lg-4 col-md-6 col-sm-12 mb-30">
                <div class="product-box">
                    <div class="producct-img"><img src="<?=BASE_URL('');?>assets/img/fakelink.png" width="100%"
                            height="100%" alt=""></div>
                    <div class="product-caption">
                        <h4><a href="<?=BASE_URL('service/fake-link');?>">FAKE LINK SHARE</a></h4>
                        <div class="price">
                            Giải pháp giả mạo tiêu đề, mô tả, ảnh website khi chia sẻ lên mạng xã hội.
                        </div>
                        <a href="<?=BASE_URL('service/fake-link');?>" class="btn btn-outline-primary">Sử Dụng Ngay</a>
                    </div>
                </div>
            </li>
        </ul>


        <?php
require_once __DIR__.'/footer.php';
?>