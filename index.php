<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/functions/function.php';
require_once __DIR__.'/functions/sendEmail.php';
require_once __DIR__.'/class/Mobile_Detect.php';


if($CMSNT->site('status') != 1)
{
    header("location: ".BASE_URL('views/ladipage/index.html'));
    exit();
}
if(isset($_GET['url']))
{ 
    $url = check_string($_GET['url']);
    if(!$row = $CMSNT->get_row("SELECT * FROM `links` WHERE `url_fake` = '$url' AND `status` = 1 "))
    {
        header("location: ".BASE_URL('')); 
        exit();
    }
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,minimum-scale=1" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:image" content="<?=BASE_URL($row['url_img']);?>" />
    <meta name="twitter:image:src" content="<?=BASE_URL($row['url_img']);?>" />
    <meta property="og:title" content="<?=$row['title'];?>" />
    <meta name="twitter:title" content="<?=$row['title'];?>" />
    <meta property="og:description" content="<?=$row['description'];?>" />
    <meta name="twitter:description" content="<?=$row['description'];?>" />
    <meta name="twitter:app:country" content="US" />
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
    <input type="hidden" id="url" value="<?=$row['url_fake'];?>" class="form-control">
    <div id="thongbao"></div>
    <script type="text/javascript">
    function load_tinnhan() {
        $.ajax({
            url: "<?=BASE_URL('assets/ajaxs/fklink.php');?>",
            type: "GET",
            dateType: "text",
            data: {
                url: $("#url").val()
            },
            success: function(n) {
                location.href = n;
                //$("#thongbao").html(n);
            }
        });
    }
    setInterval(function() { $('#thongbao').load(load_tinnhan()); }, 1000);
    </script>
</body>
</html>
<?php
    die(); 
} 
if(isset($_GET['email_verified']))
{
    $email = check_string($_GET['email_verified']);
    if($row = $CMSNT->get_row("SELECT * FROM `users` WHERE `email_verified` = '$email' "))
    {
        if(time() - $row['time_verified'] >= 300)
        {
            die('Liên kết xác minh đã hết hạn, vui lòng xác thực lại.');
        }
        else
        {
            $new_password = random('0123456789', 6);
            $CMSNT->update("users", [
                'password'  => TypePassword($new_password)
            ], " `id` = '".$row['id']."' ");
            $guitoi = $row['email'];   
            $subject = 'THÔNG TIN ĐĂNG NHẬP DỊCH VỤ';
            $bcc = $CMSNT->site('title');
            $hoten ='Quý khách hàng';
            $noi_dung = '<h2>Đây là thông tin đăng nhập mới của quý khách</h2>
            <table>
            <tbody>
            <tr>
            <td>Tên đăng nhập:</td>
            <td><b>'.$row['username'].'</b></td>
            </tr>
            <tr>
            <td>Mật khẩu mới:</td>
            <td><b>'.$new_password.'</b></td>
            </tr>
            <tr>
            <td>Vui lòng thay đổi mật khẩu để tăng bảo mật tài khoản.</td>
            </tr>
            </tbody>
            </table>';
            sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc);
            die('Thông tin đăng nhập đã được gửi đến địa chỉ Email của quý khách, vui lòng kiểm tra...');
        }
    }
}


header("location: ".BASE_URL('views/client/index.php')); 
exit();