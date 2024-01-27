<?php
/**
 * GỬI SMS API SMS.CMSNT.CO
 * Website: https://sms.cmsnt.co/api.php
 */

function sendSMS($apikey, $number, $content, $device)
{
    $url = 'https://sms.cmsnt.co/services/send.php?key='.$apikey.'&number='.$number.'&message='.urlencode($content).'&devices='.$device.'&type=sms';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($data, true);
    if($data['success'] == true)
    {
        return true;
    }
    else
    {
        return false;
    }
}