<?php
    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/../functions/function.php';

    /**
     * CRON 1 PHÚT 1 LẦN
     */
    
    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if($CMSNT->site('status_bank') != 1)
    {
        die('Chức năng đang tắt.');
    }
    if($CMSNT->site('token_bank') == '')
    {
        die('Thiếu Token');
    }
    $token = $CMSNT->site('token_bank');
    $stk = $CMSNT->site('stk_bank');
    $mk = $CMSNT->site('mk_bank');

    if($CMSNT->site('type_bank') == 'Vietcombank')
    {
        $result = curl_get("https://api.web2m.com/historyapivcb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['status'] != true)
        {
            die($result['msg']);
        }
        foreach($result['data']['ChiTietGiaoDich'] as $data)
        {
            $des = $data['MoTa'];
            $amount = str_replace(',' ,'', $data['SoTienGhiCo']);
            $tid = $data['SoThamChieu'];
            $id = parse_order_id($des);
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `tid` = '$tid' ") == 0)
                    {
                        if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `description` = '$des' ") == 0)
                        {
                            /* GHI LOG BANK AUTO */
                            $create = $CMSNT->insert("bank_logs", array(
                                'tid' => $tid,
                                'description' => $des,
                                'amount' => $amount,
                                'time' => gettime(),
                                'user_id' => $row['id']
                                ));
                            if ($create)
                            {
                                $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                                $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                                if($isCheckMoney)
                                {
                                    $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                    /* GHI LOG DÒNG TIỀN */
                                    $CMSNT->insert("dongtien", array(
                                        'sotientruoc' => $row['money'],
                                        'sotienthaydoi' => $real_amount,
                                        'sotiensau' => $row['money'] + $real_amount,
                                        'thoigian' => gettime(),
                                        'noidung' => 'Nạp tiền tự động ngân hàng ('.$des.')',
                                        'user_id' => $row['id']
                                    ));
                                }
                            }
                        }
                    }
                }
            }    
        }
        die();
    }
    if($CMSNT->site('type_bank') == 'Techcombank')
    {
        $result = curl_get("https://api.web2m.com/historyapitcb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['success'] != true)
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['transactions'] as $data)
        {
            $des = $data['Description'];
            $amount = str_replace(',' ,'', $data['Amount']);
            $tid = explode('\\', $data['TransID'])[0];
            $id = parse_order_id($des);
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `tid` = '$tid' ") == 0)
                    {
                        if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `description` = '$des' ") == 0)
                        {
                            /* GHI LOG BANK AUTO */
                            $create = $CMSNT->insert("bank_logs", array(
                                'tid' => $tid,
                                'description' => $des,
                                'amount' => $amount,
                                'time' => gettime(),
                                'user_id' => $row['id']
                                ));
                            if ($create)
                            {
                                $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                                $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                                if($isCheckMoney)
                                {
                                    $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                    /* GHI LOG DÒNG TIỀN */
                                    $CMSNT->insert("dongtien", array(
                                        'sotientruoc' => $row['money'],
                                        'sotienthaydoi' => $real_amount,
                                        'sotiensau' => $row['money'] + $real_amount,
                                        'thoigian' => gettime(),
                                        'noidung' => 'Nạp tiền tự động ngân hàng (Techcombank | '.$tid.')',
                                        'user_id' => $row['id']
                                    ));
                                }
                            }
                        }
                    }
                }
            }    
        }
        die();
    }

    if($CMSNT->site('type_bank') == 'ACB')
    {
        $result = curl_get("https://api.web2m.com/historyapiacb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['success'] != true)
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['transactions'] as $data)
        {
            $des = $data['description'];
            $amount = $data['amount'];
            $tid = $data['transactionNumber'];
            $id = parse_order_id($des);
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `tid` = '$tid' ") == 0)
                    {
                        /* GHI LOG BANK AUTO */
                        $create = $CMSNT->insert("bank_logs", array(
                            'tid' => $tid,
                            'description' => $des,
                            'amount' => $amount,
                            'time' => gettime(),
                            'user_id' => $row['id']
                            ));
                        if ($create)
                        {
                            $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                            $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                            if($isCheckMoney)
                            {
                                $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                /* GHI LOG DÒNG TIỀN */
                                $CMSNT->insert("dongtien", array(
                                    'sotientruoc' => $row['money'],
                                    'sotienthaydoi' => $real_amount,
                                    'sotiensau' => $row['money'] + $real_amount,
                                    'thoigian' => gettime(),
                                    'noidung' => 'Nạp tiền tự động ngân hàng (ACB | '.$tid.')',
                                    'user_id' => $row['id']
                                ));
                            }
                        }
                    }
                }
            }    
        }
        die();
    }

    if($CMSNT->site('type_bank') == 'MBBank')
    {
        $result = curl_get("https://api.web2m.com/historyapimb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if($result['success'] != true)
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['data'] as $data)
        {
            $des = $data['description'];
            $amount = $data['creditAmount'];
            $tid = explode('\\', $data['refNo'])[0];
            $id = parse_order_id($des);
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `tid` = '$tid' ") == 0)
                    {
                        if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `description` = '$des' ") == 0)
                        {
                            /* GHI LOG BANK AUTO */
                            $create = $CMSNT->insert("bank_logs", array(
                                'tid' => $tid,
                                'description' => '1.4.0'.$des,
                                'amount' => $amount,
                                'time' => gettime(),
                                'user_id' => $row['id']
                                ));
                            if ($create)
                            {
                                $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                                $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                                if($isCheckMoney)
                                {
                                    $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                    /* GHI LOG DÒNG TIỀN */
                                    $CMSNT->insert("dongtien", array(
                                        'sotientruoc' => $row['money'],
                                        'sotienthaydoi' => $real_amount,
                                        'sotiensau' => $row['money'] + $real_amount,
                                        'thoigian' => gettime(),
                                        'noidung' => 'Nạp tiền tự động ngân hàng (MB Bank | '.$tid.')',
                                        'user_id' => $row['id']
                                    ));
                                }
                            }
                        }
                    }
                }
            }    
        }
        die();
    }

    if($CMSNT->site('type_bank') == 'VPBank')
    {
        $result = curl_get("https://api.web2m.com/historyapivpb/$mk/$stk/$token");
        $result = json_decode($result, true);
        if(!isset($result['d']['DepositAccountTransactions']['results']))
        {
            die('Lấy dữ liệu thất bại');
        }
        foreach($result['d']['DepositAccountTransactions']['results'] as $data)
        {
            $des = $data['Description'];
            $amount = $data['Amount'];
            $tid = explode('\\', $data['ReferenceNumber'])[0];
            $id = parse_order_id($des);
            if ($id)
            {
                $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id' ");
                if($row['username'])
                {
                    if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `tid` = '$tid' ") == 0)
                    {
                        if($CMSNT->num_rows(" SELECT * FROM `bank_logs` WHERE `description` = '$des' ") == 0)
                        {
                            /* GHI LOG BANK AUTO */
                            $create = $CMSNT->insert("bank_logs", array(
                                'tid' => $tid,
                                'description' => '1.4.0'.$des,
                                'amount' => $amount,
                                'time' => gettime(),
                                'user_id' => $row['id']
                                ));
                            if ($create)
                            {
                                $real_amount = $amount + $amount * $CMSNT->site('ck_bank') / 100;
                                $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");
                                if($isCheckMoney)
                                {
                                    $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                                    /* GHI LOG DÒNG TIỀN */
                                    $CMSNT->insert("dongtien", array(
                                        'sotientruoc' => $row['money'],
                                        'sotienthaydoi' => $real_amount,
                                        'sotiensau' => $row['money'] + $real_amount,
                                        'thoigian' => gettime(),
                                        'noidung' => 'Nạp tiền tự động ngân hàng (VPBank | '.$tid.')',
                                        'user_id' => $row['id']
                                    ));
                                }
                            }
                        }
                    }
                }
            }    
        }
        die();
    }




 