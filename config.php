<?php
session_start();
require_once __DIR__.'/database/db.php';
require_once __DIR__.'/class/class.cmsnt.php';

$config = [
    'project'   => 'FAKELINK',
    'version'   => '1.1.6',
    'timezone'  => 'Asia/Ho_Chi_Minh'
];



$CMSNT = new CMSNT;
define('URL_FAKE', $CMSNT->site('url_fake'));
date_default_timezone_set($config['timezone']);
function getUser($id, $row)
{
    global $CMSNT;
    return $CMSNT->get_row("SELECT * FROM `users` WHERE `id` = '$id' ")[$row];
}
function getUserName($username, $row)
{
    global $CMSNT;
    return $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' ")[$row];
}
function getSetting($name)
{
    global $CMSNT;
    return $CMSNT->get_row("SELECT * FROM `settings` WHERE `name` = '$name' ")['value'];
}
function BASE_URL($url)
{
    global $config;
    $a = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
    if($a == 'http://localhost'){
        $a = 'http://localhost/CMSNT.CO/'.$config['project'];
    }
    return $a.'/'.$url;
}