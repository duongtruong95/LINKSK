<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets\ajaxs\client\delete-fake-link.php
     */
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../includes/login.php';

    if(isset($_POST['id']))
    {
        $id = check_string($_POST['id']);
        $user = $CMSNT->get_row("SELECT * FROM `links` WHERE `id` = '$id' AND `user_id` = '".$getUser['id']."'  ");
        if(!$user)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Dữ liệu không tồn tại'
            ]);
            die($data);
        }
        $isRemove = $CMSNT->remove("links", " `id` = '$id' ");
        if($isRemove)
        {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Xóa link thành công.'
            ]);
            die($data);
        }
    }
    else
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Xóa link thất bại.'
        ]);
        die($data);
    }