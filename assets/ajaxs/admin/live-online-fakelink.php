<?php 
 
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../includes/login-admin.php';

    $time_online = 30;
    echo "<p style='font-size:18px;'>Tổng trực tuyến: ".format_cash($CMSNT->get_row("SELECT COUNT(*) FROM `link_views` WHERE ".time()." - `online` <= $time_online ")['COUNT(*)'])."</p>";
    foreach($CMSNT->get_list("SELECT *, COUNT(*) as total FROM `link_views` WHERE ".time()." - `online` <= $time_online GROUP BY `link_id` ORDER BY total DESC LIMIT 5") as $row){
        $view = $CMSNT->get_row("SELECT COUNT(*) FROM `link_views` WHERE ".time()." - `online` <= $time_online AND `link_id` = '".$row['link_id']."' ")['COUNT(*)'];
        $link = $CMSNT->get_row("SELECT * FROM `links` WHERE `id` = '".$row['link_id']."' ")['domain'].'/'.$CMSNT->get_row("SELECT * FROM `links` WHERE `id` = '".$row['link_id']."' ")['url_fake'];
        echo "
            <p><span style='font-size:25px;'>".format_cash($view)."</span> Online - <a href='$link' target='_blank'>$link</a></p>
        ";
    }
?>

