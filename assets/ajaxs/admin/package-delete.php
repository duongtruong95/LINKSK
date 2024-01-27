<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets\ajaxs\admin\package-delete.php
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
                'msg'       => 'Chức năng này không thể sử dụng trên trang web demo.'
            ]);
            die($data);
        }
        $id = check_string($_POST['id']);
        $row = $CMSNT->get_row("SELECT * FROM `packages` WHERE `id` = '$id' ");
        if(!$row)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Dữ liệu không tồn tại trong hệ thống'
            ]);
            die($data);
        }
        $isRemove = $CMSNT->remove("packages", " `id` = '$id' ");
        if($isRemove)
        {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Xóa gói thành công'
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