<?php
    require_once __DIR__.'/../class/class.smtp.php';
    require_once __DIR__.'/../class/PHPMailerAutoload.php';
    require_once __DIR__.'/../class/class.phpmailer.php';

    function sendCSM($mail_nhan,$ten_nhan,$chu_de,$noi_dung,$bcc)
    {

        global $CMSNT;
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail ->Debugoutput = "html";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $CMSNT->site('email_smtp'); // GMAIL STMP
        $mail->Password = $CMSNT->site('pass_email_smtp'); // PASS STMP
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($CMSNT->site('email_smtp'), $bcc);
        $mail->addAddress($mail_nhan, $ten_nhan);
        $mail->addReplyTo($CMSNT->site('email_smtp'), $bcc);
        $mail->isHTML(true);
        $mail->Subject = $chu_de;
        $mail->Body    = $noi_dung;
        $mail->CharSet = 'UTF-8';
        $send = $mail->send();
        return $send;
    }