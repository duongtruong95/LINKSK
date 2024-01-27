<?php 
    require_once __DIR__.'/../../config.php';
    require_once __DIR__.'/../../functions/function.php';
    require_once __DIR__.'/../../class/Mobile_Detect.php';

    if(isset($_GET['url']))
    {
        $url = check_string($_GET['url']);
        if(!$row = $CMSNT->get_row("SELECT * FROM `links` WHERE `url_fake` = '$url' AND `status` = 1 "))
        {
            header("location: ".BASE_URL('')); 
            exit();
        }
        if($CMSNT->num_rows(" SELECT * FROM `link_views` WHERE `link_id` = '".$row['id']."' AND `ip` = '".myip()."' ") == 0){
            $CMSNT->cong("links", "views", 1, " `url_fake` = '$url' ");
            $Mobile_Detect = new Mobile_Detect;
            $CMSNT->insert("link_views", [
                'link_id'   => $row['id'],
                'country'   => GetCountry(myip()),
                'ip'        => myip(),
                'UserAgent' => $Mobile_Detect->getUserAgent(),
                'device'    => getDevice(),
                'browser'   => getBrowser()['name'],
                'redirect'  => $row['url_href'],
                'createdate'=> gettime(),
                'online'    => time()
            ]);
        }
        die($row['url_href']);
    }
