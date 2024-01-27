<?php 
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../includes/login.php';

    if(isset($_POST['id']))
    {
        $id = check_string($_POST['id']);
        if(!$row = $CMSNT->get_row("SELECT * FROM `packages` WHERE `id` = '$id' "))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Gói dịch vụ không tồn tại trong hệ thống.'
            ]);
            die($data);
        }
        if($row['price'] > $getUser['money'])
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Số dư không đủ, vui lòng nạp thêm.'
            ]);
            die($data);
        }
        $isTru = $CMSNT->tru("users", "money", $row['price'], " `id` = '".$getUser['id']."' ");
        if($isTru)
        {
            $CMSNT->cong("users", "expired", $row['expired'], " `id` = '".$getUser['id']."' ");
            $CMSNT->insert("package_logs", [
                'user_id'   => $getUser['id'],
                'name'      => $row['name'],
                'expired'   => $row['expired'],
                'price'     => $row['price'],
                'createdate'=> gettime()
            ]);
            $CMSNT->insert("dongtien", [
                'user_id'       => $getUser['id'],
                'sotientruoc'   => $getUser['money'],
                'sotienthaydoi' => $row['price'],
                'sotiensau'     => $getUser['money'] - $row['price'],
                'thoigian'      => gettime(),
                'noidung'       => "Thanh toán gói ".$row['name'],
            ]);

            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Tài khoản của bạn đã được gia hạn thêm '.$row['expired'].' ngày.'
            ]);
            die($data);
        }
    }
    else
    {
        $data = json_encode([
            'status'    => 'error',
            'msg'       => 'Gói dịch vụ không tồn tại trong hệ thống.'
        ]);
        die($data);
    }