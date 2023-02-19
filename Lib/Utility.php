<?php

require_once(HOME_PATH.'/vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Utility{

    public static function EncryptPassword($password)
    {
        return PasswordUtil::EncryptPassword($password);
    }

    public static function DecryptPassword($password_hash)
    {
        return PasswordUtil::DecryptPassword($password_hash);
    }


    public static function GetTimeStamp($var = "Y-m-d H:i:s")
    {
        $date = date($var);
        return $date;

    }


    public static function GetPlanExpiry($purchase_date, $duration_d,$duration_h = 0, $format = "Y-m-d H:i:s")
    {
        $date = date_create($purchase_date);
        $interval = $duration_d . " days";
        if($duration_h>0){
            $interval = $interval . " " . $duration_h . " hours";
        }
        date_add($date, date_interval_create_from_date_string($interval));

        return date_format($date, $format);
    }


    public static function GenerateOtp($var = 6)
    {

        $otp = "";
        for ($i=0; $i < $var; $i++) {
            $number = rand(1, 9)."";
            $otp .= $number;
        }
        
        return $otp;

    }


    public static function sendMail($data, $is_html = true){


        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = MAIL_HOST;                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = MAIL_USERNAME;                     // SMTP username
            $mail->Password   = MAIL_PASSWORD;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom(MAIL_FROM, MAIL_NAME);
            // $mail->addAddress('irfanzsheikhz@gmail.com', 'Irfan Sheikh');     // Add a recipient
            $mail->addAddress($data['to'],$data['name']);               // Name is optional
            $mail->addReplyTo(MAIL_REPLYTO);
            // $mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML($is_html);                                  // Set email format to HTML
            $mail->Subject = $data['subject'];
            $mail->Body    = $data['message'];
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            $array['code'] = 200;
            $array['msg'] = "success";

            return $array;
        } catch (Exception $e) {

            $array['code'] = 201;
            $array['msg'] =  $mail->ErrorInfo;

            return $array;
        }

    }


    public static function base64ToImage($filePath,$base64)
    {
        $img = $base64; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        return file_put_contents($filePath, $data);

    }


}

?>