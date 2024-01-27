<?php 
    require_once __DIR__.'/../config.php';
    require_once __DIR__.'/../functions/function.php';
    /**
     * CRON 1 PHÚT 1 LẦN
     */
    if(time() - $CMSNT->site('time_cron_24h') >= 86400)
    {
        // TRỪ THỜI GIAN HẠN SỬ DỤNG CỦA KHÁCH HÀNG
        foreach($CMSNT->get_list("SELECT * FROM `users` WHERE `expired` > 0 ") as $row)
        {
            $CMSNT->tru("users", 'expired', 1, " `id` = '".$row['id']."' ");
            $CMSNT->update('settings', [
                'value' => time()
                ], " `name` = 'time_cron_24h' ");
        }
    }