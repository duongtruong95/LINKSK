<?php
/**
 * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
 * WEBSITE: https://www.cmsnt.co/
 */


if(isset($_SESSION['user_id']))
{
    $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `admin` = 1 AND `id` = '".$_SESSION['user_id']."'  ");
    if(!$getUser)
    {
        header("location:".BASE_URL('Auth/Login'));
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
    header("location:".BASE_URL('Auth/Login'));
    exit();
}