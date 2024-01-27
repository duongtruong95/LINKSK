<?php 
    require_once __DIR__.'/../../../config.php';
    require_once __DIR__.'/../../../functions/function.php';
    require_once __DIR__.'/../../../functions/sendEmail.php';
    require_once __DIR__.'/../../../class/Mobile_Detect.php';


    /**
     * CMSNT.CO - TỐI ƯU HÓA QUY TRÌNH KIẾM TIỀN ONLINE CỦA BẠN
     * WEBSITE: https://www.cmsnt.co/
     * PATH: assets\ajaxs\client\auth.php
     */

    if(empty($_POST['action']))
    {
        die('Bạn không có quyền truy cập trang này!');
    }
    if($_POST['action'] == 'Login')
    {
        $username = check_string($_POST['username']);
        $password = TypePassword(check_string($_POST['password']));
        if(empty($username)){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Tên đăng nhập không được để trống'
            ]);
            die($data);
        }
        if(empty($password)){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Mật khẩu không được để trống'
            ]);
            die($data);
        }
        $getUser = $CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'  ");
        if(!$getUser){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Thông tin đăng nhập không chính xác'
            ]);
            die($data);
        }
        $Mobile_Detect = new Mobile_Detect;
        $CMSNT->update("users", [
            'otp'       => NULL,
            'ip'        => myip(),
            'updatedate' => gettime(),
            'device'    => $Mobile_Detect->getUserAgent(),
            'time_otp'  => NULL
        ], " `username` = '".$getUser['username']."' ");
        $CMSNT->insert("logs", [
            'user_id'       => $getUser['id'],
            'ip'            => myip(),
            'device'        => $Mobile_Detect->getUserAgent(),
            'createdate'    => gettime(),
            'action'        => 'Đăng nhập thành công vào hệ thống.'
        ]);
        $_SESSION['user_id'] = $getUser['id'];
        $_SESSION['user_password'] = $getUser['password'];
        $data = json_encode([
            'status'    => 'success',
            'msg'       => 'Đăng nhập thành công'
        ]);
        die($data);
    }


    if($_POST['action'] == 'Register')
    {
        $username = check_string($_POST['username']);
        $password = check_string($_POST['password']);
        $email = check_string($_POST['email']);
        if(empty($username)){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Tên đăng nhập không được để trống'
            ]);
            die($data);
        }
        if(check_username($username) != true){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Định đạng tài khoản không hợp lệ'
            ]);
            die($data);
        }
        if(empty($email)){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Email không được để trống'
            ]);
            die($data);
        }
        if(check_email($email) != true){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Định dạng email không hợp lệ'
            ]);
            die($data);
        }
        if(empty($password)){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Mật khẩu không được để trống'
            ]);
            die($data);
        }
        if($CMSNT->get_row("SELECT * FROM `users` WHERE `username` = '$username'  ")){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Tên đăng nhập đã tồn tại trong hệ thống'
            ]);
            die($data);
        }
        if($CMSNT->get_row("SELECT * FROM `users` WHERE `email` = '$email'  ")){
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Địa chỉ email đã tồn tại trong hệ thống'
            ]);
            die($data);
        }
        $Mobile_Detect = new Mobile_Detect;
        $CMSNT->insert("users", [
            'username'  => $username,
            'password'  => TypePassword($password),
            'email'     => $email,
            'email_verified' => NULL,
            'createdate'    => gettime(),
            'updatedate'    => gettime(),
            'money'         => 0,
            'total_money'   => 0,
            'used_money'    => 0,
            'device'        => NULL,
            'admin'         => 0,
            'banned'        => 0,
            'otp'           => NULL,
            'phone'         => NULL,
            'time_otp'      => NULL,
            'ip'        => myip(),
            'device'    => $Mobile_Detect->getUserAgent()
        ]);
        $data = json_encode([
            'status'    => 'success',
            'msg'       => 'Đăng ký thành công'
        ]);
        die($data);
    }


    if($_POST['action'] == 'ChangePassword')
    {
        $getUser = $CMSNT->get_row(" SELECT * FROM `users` WHERE `id` = '".$_SESSION['user_id']."' ");
        if(!$getUser)
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng đăng nhập để sử dụng chức năng này.'
            ]);
            die($data);
        }
        if(empty($_POST['password']))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng nhập mật khẩu hiện tại.'
            ]);
            die($data);
        }
        if(empty($_POST['newpassword']))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Vui lòng nhập mật khẩu mới.'
            ]);
            die($data);
        }
        if($_POST['newpassword'] != $_POST['renewpassword'])
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Nhập lại mật khẩu không khớp.'
            ]);
            die($data);
        }
        if( TypePassword($_POST['password']) != $getUser['password'])
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Mật khẩu hiện tại không chính xác.'
            ]);
            die($data);
        }
        $isUpdate = $CMSNT->update("users", [
            'password'  => check_string(TypePassword($_POST['newpassword']))
        ], " `id` = '".$getUser['id']."' ");
        if($isUpdate)
        {
            $data = json_encode([
                'status'    => 'success',
                'msg'       => 'Thay đổi mật khẩu thành công.'
            ]);
            die($data);
        }
        else
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Không thể thay đổi mật khẩu.'
            ]);
            die($data);
        }
    }
 
    if($_POST['action'] == 'ForgotPassword')
    {
        if(!isset($_POST['email']))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Bạn chưa nhập địa chỉ Email cần khôi phục.'
            ]);
            die($data);
        }
        $email = check_string($_POST['email']);
        if(!$row = $CMSNT->get_row(" SELECT * FROM `users` WHERE `email` = '$email' "))
        {
            $data = json_encode([
                'status'    => 'error',
                'msg'       => 'Địa chỉ Email này không tồn tại trong hệ thống.'
            ]);
            die($data);
        }
        $token = random('qwertyuiopasdghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456798', 32);
        $CMSNT->update("users", [
            'time_verified'     => time(),
            'email_verified'    => $token
        ], " `id` = '".$row['id']."' ");

        $guitoi = $row['email'];   
        $subject = 'XÁC NHẬN KHÔI PHỤC MẬT KHẨU';
        $bcc = $CMSNT->site('title');
        $hoten ='Quý khách hàng';
        $noi_dung = '<h2>Bạn đang yêu cầu cấp lại mật khẩu?</h2>
        <table>
        <tbody>
        <tr>
        <td style="font-size:25px;">Nếu bạn đang yêu cầu cấp lại mật khẩu vui lòng nhấn vào liên kết dưới đây để tiến hành xác thực thông tin, chúng tôi sẽ gửi lại mật khẩu mới cho bạn sau khi hoàn tất quá trình xác minh.</td>
        </tr>
        <tr>
        <td><a href="'.BASE_URL('?email_verified='.$token).'" target="_blank" style="color:blue;font-size:15px;">'.BASE_URL('?email_verified='.$token).'</a> (có hiệu lực trong 5 phút)</td>
        </tr>
        </tbody>
        </table>';
        sendCSM($guitoi, $hoten, $subject, $noi_dung, $bcc); 
        $data = json_encode([
            'status'    => 'success',
            'msg'       => 'Chúng tôi đã gửi cho bạn email xác minh, vui lòng kiểm tra.'
        ]);
        die($data);
    }