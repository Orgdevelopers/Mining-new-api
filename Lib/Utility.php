<?php

require_once(HOME_PATH.'/vendor/autoload.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Utility{

    public static function EncryptPassword($password)
    {
        $privateKey 	= 'CAPITAL09KEYFORTESTING33HQ1HQ2HQ3L0L'; 
        $secretKey 		= '1j2gh28i3h9'; 
        $encryptMethod      = "AES-256-CBC";
        $string 		= $password; 

        $key = hash('sha256', $privateKey);
        $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo
        $result = openssl_encrypt($string, $encryptMethod, $key, 0, $ivalue);
        $output = base64_encode($result);  // output is a encripted value

        return $output;
    }

    public static function DecryptPassword($password_hash)
    {
        $privateKey 	= 'CAPITAL09KEYFORTESTING33HQ1HQ2HQ3L0L'; 
        $secretKey 		= '1j2gh28i3h9'; 
        $encryptMethod      = "AES-256-CBC";
        $stringEncrypt      = $password_hash; 

        $key    = hash('sha256', $privateKey);
        $ivalue = substr(hash('sha256', $secretKey), 0, 16); // sha256 is hash_hmac_algo

        $output = openssl_decrypt(base64_decode($stringEncrypt), $encryptMethod, $key, 0, $ivalue);

        return $output;
    }


    public static function GetTimeStamp($var = "Y-m-d H:i:s")
    {
        $date = date($var);
        return $date;

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


}

?>