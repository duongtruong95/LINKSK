<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets\ajaxs\admin\user-delete.php
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
        $isRemove = $CMSNT->remove("users", " `id` = '$id' ");
        if($isRemove)
        {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Xóa người dùng thành công'
            ]);
            die($data);
        }
    }
    else
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Dữ liệu không hợp lệ'
        ]);
        die($data);
    }