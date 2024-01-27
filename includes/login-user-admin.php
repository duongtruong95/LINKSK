<?php
require_once __DIR__.'/../config.php';
require_once __DIR__.'/../functions/function.php';
require_once __DIR__.'/login-admin.php';

if(isset($_GET['id']))
{
    $id = check_string($_GET['id']);
    $getUser = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '$id' ");
    if(!$getUser)
    {
        die('Không thể kết nối đến tài khoản này, thông tin tài khoản không tồn tại trong hệ thống.');
    }
    $_SESSION['user_id'] = $getUser['id'];
    $_SESSION['user_password'] = $getUser['password'];
    header("location:".BASE_URL(''));
    exit();
}