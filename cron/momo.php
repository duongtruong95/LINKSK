<?php
    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/../functions/function.php';


    /**
     * CRON 1 PHÚT 1 LẦN
     */
    
    /* ĐƠN VỊ THIẾT KẾ WEB WWW.CMSNT.CO | ZALO 0947838128 | FB.COM/NTGTANETWORK */
    if($CMSNT->site('status_momo') != 1)
    {
        die('Chức năng đang tắt.');
    }
    if($CMSNT->site('token_momo') == '')
    {
        die('Thiếu Token');
    }

    $token = $CMSNT->site('token_momo');
    $result = curl_get("https://api.web2m.com/historyapimomo1h/$token");
    $result = json_decode($result, true);
    if(!isset($result['momoMsg']['tranList']))
    {
        die($result['msg']);
    }
    foreach($result['momoMsg']['tranList'] as $data)
    {
        $partnerId      = $data['partnerId'];               // SỐ ĐIỆN THOẠI CHUYỂN
        $comment        = $data['comment'];                 // NỘI DUNG CHUYỂN TIỀN
        $tranId         = $data['tranId'];                  // MÃ GIAO DỊCH
        $partnerName    = $data['partnerName'];             // TÊN CHỦ VÍ
        $id_momo        = parse_order_id($comment);         // TÁCH NỘI DUNG CHUYỂN TIỀN
        $amount         = $data['amount'];
        if ($id_momo)
        {
            $row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '$id_momo' ");
            if($row['id'])
            {
                if($CMSNT->num_rows(" SELECT * FROM `momo_logs` WHERE `tranId` = '$tranId' ") == 0)
                {
                    $create = $CMSNT->insert("momo_logs", array(
                        'tranId'        => $tranId,
                        'user_id'       => $row['id'],
                        'comment'       => $comment,
                        'time'          => gettime(),
                        'partnerId'     => $partnerId,
                        'amount'        => $amount,
                        'partnerName'   => $partnerName
                    ));
                    if ($create)
                    {
                        $real_amount = $amount;
                        $isCheckMoney = $CMSNT->cong("users", "money", $real_amount, " `username` = '".$row['username']."' ");

                        if($isCheckMoney)
                        {
                            $CMSNT->cong("users", "total_money", $real_amount, " `username` = '".$row['username']."' ");
                            $CMSNT->insert("dongtien", array(
                                'sotientruoc'   => $row['money'],
                                'sotienthaydoi' => $real_amount,
                                'sotiensau'     => $row['money'] + $real_amount,
                                'thoigian'      => gettime(),
                                'noidung'       => 'Nạp tiền tự động qua ví MOMO ('.$tranId.')',
                                'user_id'      => $row['id']
                            ));
                        }
                    }
                }
            }
        }         
    }
 