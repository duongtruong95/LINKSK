<?php
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */


if(time() - $CMSNT->site('time_cron_24h') >= 86400)
{
    // TRỪ THỜI GIAN HẠN SỬ DỤNG CỦA KHÁCH HÀNG
    foreach($CMSNT->get_list("SELECT * FROM `users` WHERE `expired` > 0 ") as $row)
    {
        $CMSNT->tru("users", 'expired', 1, " `id` = '".$row['id']."' ");
        $resultExpired = $CMSNT->get_list("SELECT * FROM `users` WHERE `id` = '".$row['id']."' AND expired < 1");
        if (count($resultExpired)) {
            $CMSNT->update("users", [
                'max_link'  => 0,
            ], " `id` = '".$row['id']."' ");
            $CMSNT->update("campaigns", [
                'status' => 1,
            ], " `user_id` = '" . $row['id'] . "' ");
            $CMSNT->update("links", [
                'status' => 0,
            ], " `user_id` = '" . $row['id'] . "' ");
        }
        $CMSNT->update('settings', [
            'value' => time()
        ], " `name` = 'time_cron_24h' ");
    }
}
if(isset($_SESSION['user_id']))
{
    $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '".$_SESSION['user_id']."' ");
    /* ONLINE */
    $CMSNT->update("users", [
        'time_session'  => time()
    ], " `id` = '".$getUser['id']."' ");
    if(!$getUser)
    {
        header("location:".BASE_URL('views/client/login.php'));
        exit();
    }
    if($getUser['banned'] != 0)
    {
        die('Tài khoản của bạn đã bị khóa!');
    }
    if(isset($_SESSION['user_password']))
    {
        if($_SESSION['user_password'] != $getUser['password'])
        {
            header("location:".BASE_URL('includes/logout.php'));
            exit();
        }
    }
    else
    {
        header("location:".BASE_URL('includes/logout.php'));
        exit();
    }
}
else
{
    header("location:".BASE_URL('views/client/login.php'));
    exit();
}