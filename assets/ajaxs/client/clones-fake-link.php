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
        if(!$amount = check_string($_POST['amount']))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng nhập số lượng cần tạo'
            ]);
            die($data);
        }
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
        $list = '';
        for ($i=0; $i < $amount ; $i++)
        { 
            $rand_url = random('0123456789QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm', 7);
            if($CMSNT->get_row("SELECT * FROM `links` WHERE `url_fake` = '$rand_url' "))
            {
                $data = json_encode([
                    'status'    => 'error',
                    'msg'       => 'Vui lòng thử lại'
                ]);
                die($data);
            }
            $CMSNT->insert('links', [
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
            $list .= $row['domain'].'/'.$rand_url.PHP_EOL;
        }

        $data = json_encode([
            'list'      => $list,
            'status'    => 'success',
            'msg'       => 'Clone thành công!'
        ]);
        die($data);
    }
    else
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Clone thất bại'
        ]);
        die($data);
    }