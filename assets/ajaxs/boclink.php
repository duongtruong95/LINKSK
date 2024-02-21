<?php 
    header("Access-Control-Allow-Origin: *");
    require_once __DIR__.'/../../config.php';
    require_once __DIR__.'/../../functions/function.php';
    require_once __DIR__.'/../../class/Mobile_Detect.php';

    $trans_id = check_string($_GET['v']);
    $row = $CMSNT->get_row("SELECT * FROM `campaigns` WHERE `trans_id` = '$trans_id' ");
    if(!$row)
    {
        die();
    }
    $Mobile_Detect = new Mobile_Detect;
    
 
    // Truy cập link vpcs khi trạng thái camp đang tắt.
    if($row['status'] == 0 && (GetCountry(myip()) == 'vn' || GetCountry(myip()) == 'VN'))
    {
        // Nếu chặn desktop được bật, người dùng truy cập bằng máy tính sẽ luôn ở lại link sạch
        if($row['block_desktop'] == 1 && !$Mobile_Detect->isMobile())
        {
            //INSERT VIEW
            $CMSNT->cong("campaigns", "views", 1, " `trans_id` = '$trans_id' ");
            $CMSNT->insert("campaign_views", [
                'campaign_id'   => $row['id'],
                'country'   => GetCountry(myip()),
                'ip'        => myip(),
                'UserAgent' => $Mobile_Detect->getUserAgent(),
                'device'    => getDevice(),
                'browser'   => getBrowser()['name'],
                'redirect'  => $row['url_1'],
                'createdate'=> gettime()
            ]);
            // URL 1 - SẠCH
            die();
        }
        
        // Chuyển về link vpcs khi không còn điều kiện xử lý
        $CMSNT->cong("campaigns", "views", 1, " `trans_id` = '$trans_id' ");
        $CMSNT->insert("campaign_views", [
            'campaign_id'   => $row['id'],
            'country'   => GetCountry(myip()),
            'ip'        => myip(),
            'UserAgent' => $Mobile_Detect->getUserAgent(),
            'device'    => getDevice(),
            'browser'   => getBrowser()['name'],
            'redirect'  => $row['url_2'],
            'createdate'=> gettime()
        ]);
        // URL 2 VPCS
        $data = json_encode([
            'code'  => 1,
            'url'   => $row['url_2']
        ]);
        die($data);
    }

    // Truy cập link sạch nếu trạng thái camp đang được bật
    $CMSNT->cong("campaigns", "views", 1, " `trans_id` = '$trans_id' ");
    $CMSNT->insert("campaign_views", [
        'campaign_id'   => $row['id'],
        'country'   => GetCountry(myip()),
        'ip'        => myip(),
        'UserAgent' => $Mobile_Detect->getUserAgent(),
        'device'    => getDevice(),
        'browser'   => getBrowser()['name'],
        'redirect'  => $row['url_1'],
        'createdate'=> gettime()
    ]);