<?php
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 * PATH: includes\logout.php
 */
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../functions/function.php';
session_destroy();
header("location:".BASE_URL('index.php'));
exit();