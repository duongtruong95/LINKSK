<?php 
    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets\ajaxs\client\clone-fake-link.php
     */
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../includes/login.php';

    if(isset($_POST['id']))
    {
        $id = check_string($_POST['id']);
        $row = $CMSNT->get_row("SELECT * FROM `links` WHERE `id` = '$id' AND `user_id` = '".$getUser['id']."'  ");
        if(!$row)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Dữ liệu không tồn tại'
            ]);
            die($data);
        }
        $rand_url = random('0123456789QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm',5);
        if($CMSNT->get_row("SELECT * FROM `links` WHERE `url_fake` = '$rand_url' "))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng thử lại'
            ]);
            die($data);
        }
        $isClone = $CMSNT->insert('links', [
            'user_id'       => $row['user_id'],
            'title'         => $row['title'],
            'description'   => $row['description'],
            'url_href'      => $row['url_href'],
            'domain'        => $row['domain'],
            'url_fake'      => $rand_url,
            'url_img'       => $row['url_img'],
            'status'        => $row['status'],
            'createdate'    => gettime(),
            'updatedate'    => gettime()
        ]);
        if($isClone)
        {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Clone thành công!'
            ]);
            die($data);
        }
    }
    else
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Clone thất bại'
        ]);
        die($data);
    }