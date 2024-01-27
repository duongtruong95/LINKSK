<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets\ajaxs\admin\user-add.php
     */
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../includes/login-admin.php';

    if(empty($_POST['username']))
    {
        $data = json_encode([
            'code'  => 0,
            'msg'   => 'Vui lòng nhập tên đăng nhập.'
        ]);
        die($data);
    }
    if(empty($_POST['email']))
    {
        $data = json_encode([
            'code'  => 0,
            'msg'   => 'Vui lòng nhập địa chỉ Email.'
        ]);
        die($data);
    }
    if(check_email($_POST['email']) != true)
    {
        $data = json_encode([
            'code'  => 0,
            'msg'   => 'Định dạng Email không hợp lệ.'
        ]);
        die($data);
    }
    if(empty($_POST['password']))
    {
        $data = json_encode([
            'code'  => 0,
            'msg'   => 'Vui lòng nhập mật khẩu.'
        ]);
        die($data);
    }
    $username = check_string($_POST['username']);
    $email = check_string($_POST['email']);
    $password = check_string(TypePassword($_POST['password']));
    if($CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' "))
    {
        $data = json_encode([
            'code'  => 0,
            'msg'   => 'Tên đăng nhập đã được sử dụng.'
        ]);
        die($data);
    }
    if($CMSNT->get_row("SELECT * FROM `users` WHERE `email` = '$email' "))
    {
        $data = json_encode([
            'code'  => 0,
            'msg'   => 'Địa chỉ Email này đã được sử dụng.'
        ]);
        die($data);
    }
    $isAdd = $CMSNT->insert("users", [
        'username'  => $username,
        'password'  => $password,
        'email'     => $email,
        'email_verified' => NULL,
        'createdate'    => gettime(),
        'updatedate'    => gettime(),
        'money'         => 0,
        'total_money'   => 0,
        'used_money'    => 0,
        'device'        => NULL,
        'ip'            => NULL,
        'admin'         => 0,
        'banned'        => 0,
        'otp'           => NULL,
        'phone'         => NULL,
        'time_otp'      => NULL
    ]);
    if($isAdd)
    {
        $data = json_encode([
            'code'  => 1,
            'msg'   => 'Thêm tài khoản thành công.'
        ]);
        die($data);
    }
    $data = json_encode([
        'code'  => 0,
        'msg'   => 'Thêm tài khoản thất bại.'
    ]);
    die($data);