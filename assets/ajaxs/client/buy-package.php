<?php 
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../includes/login.php';

    if(isset($_POST['id']))
    {
        $id = check_string($_POST['id']);
        $total_money = check_string($_POST['total_money']);
        $month = $_POST['month'] ?? 0;
        if(!$row = $CMSNT->get_row("SELECT * FROM `packages` WHERE `id` = '$id' "))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Gói dịch vụ không tồn tại trong hệ thống.'
            ]);
            die($data);
        }
        if($total_money > $getUser['money'] && $row['is_trial_package'] != 1)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Số dư không đủ, vui lòng nạp thêm.'
            ]);
            die($data);
        }

        $CMSNT->update("campaigns", [
            'status'  => 1,
        ], " `user_id` = '".$getUser['id']."' ");
        $CMSNT->update("links", [
            'status'  => 0,
        ], " `user_id` = '".$getUser['id']."' ");

        if ($row['is_trial_package'] == 1) {
            $expiredDay = 1;
            $month = 0;
            $total_money = 0;
            $CMSNT->update("users", [
                'flg_trial_package'  => 1,
                'max_link'  => 1,
            ], " `id` = '".$getUser['id']."' ");
        } else {
            $expiredDay = $month * 30;
            $CMSNT->update("users", [
                'max_link'  => $row['number_link'],
            ], " `id` = '".$getUser['id']."' ");
        }
        $isTru = $CMSNT->tru("users", "money", $total_money, " `id` = '".$getUser['id']."' ");
        if($isTru)
        {
            $CMSNT->cong("users", "expired", $expiredDay, " `id` = '".$getUser['id']."' ");
            $CMSNT->insert("package_logs", [
                'user_id'   => $getUser['id'],
                'name'      => $row['name'],
                'expired'   => $expiredDay,
                'month'   => $month,
                'price'     => $total_money,
                'createdate'=> gettime()
            ]);
            $CMSNT->insert("dongtien", [
                'user_id'       => $getUser['id'],
                'sotientruoc'   => $getUser['money'],
                'sotienthaydoi' => $total_money,
                'sotiensau'     => $getUser['money'] - $total_money,
                'thoigian'      => gettime(),
                'noidung'       => "Thanh toán gói ".$row['name'],
            ]);
            $CMSNT->update("links", [
                'flg_old'  => 1,
            ], " `user_id` = '".$getUser['id']."' ");
            $CMSNT->update("campaigns", [
                'flg_old'  => 1,
            ], " `user_id` = '".$getUser['id']."' ");
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Tài khoản của bạn đã được gia hạn thêm '.$expiredDay.' ngày.'
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