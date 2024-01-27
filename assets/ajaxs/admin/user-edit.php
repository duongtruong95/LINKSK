<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets\ajaxs\admin\user-edit.php
     */
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../includes/login-admin.php';


    if(isset($_POST['id']))
    {
        if($CMSNT->site('status_demo') != 0)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Không được dùng chức năng này vì đây là trang web demo'
            ]);
            die($data);
        }
        if(empty($_POST['username']))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Không được để trống username.'
            ]);
            die($data);
        }
        if(empty($_POST['password']))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Không được để trống password.'
            ]);
            die($data);
        }
        $id = check_string($_POST['id']);
        $user = $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '$id' ");
        if(!$user)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'ID user không tồn tại trong hệ thống'
            ]);
            die($data);
        }
        if(isset($_POST['username']))
        {
            $username = check_string($_POST['username']);
            if($CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' AND `id` != '$id' "))
            {
                $data = json_encode([
                    'status'    => 'error',
                    'msg'       => 'Tên đăng nhập này đã tồn tại trong hệ thống'
                ]);
                die($data);
            }
        }
        if($row['money'] != $_POST['money'])
        {
            $money = check_string($_POST['money']);
            /* GHI LOG DÒNG TIỀN */
            $CMSNT->insert("dongtien", array(
                'sotientruoc' => $row['money'],
                'sotienthaydoi' => $money,
                'sotiensau' => $row['money'] - $money,
                'thoigian' => gettime(),
                'noidung' => 'Admin điều chỉnh số dư',
                'user_id' => $row['id']
            ));
        }
        $isSave = $CMSNT->update("users", [
            'username' => !empty($_POST['username']) ? check_string($_POST['username']) : 'user'.random('123456789', 6),
            'password' => !empty($_POST['password']) ? check_string($_POST['password']) : 'pw'.random('123456789', 6),
            'admin' => !empty($_POST['admin']) ? check_string($_POST['admin']) : '0',
            'banned' => !empty($_POST['banned']) ? check_string($_POST['banned']) : '0',
            'phone' => !empty($_POST['phone']) ? check_string($_POST['phone']) : '',
            'email' => !empty($_POST['email']) ? check_string($_POST['email']) : '',
            'money' => !empty($_POST['money']) ? check_string($_POST['money']) : '0',
            'total_money' => !empty($_POST['total_money']) ? check_string($_POST['total_money']) : '0',
            'used_money' => !empty($_POST['phone']) ? check_string($_POST['used_money']) : '0'
        ], " `id` = '$id' ");
        if($isSave)
        {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Cập nhật thông tin thành công'
            ]);
            die($data);
        }
        else
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Cập nhật thông tin thất bại'
            ]);
            die($data);
        }
    }
    else
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'ID user không tồn tại trong hệ thống'
        ]);
        die($data);
    }
