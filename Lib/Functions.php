<?php

function ValidatePassword($password,$db_password,$email="")
{
    $password_hash = Utility::EncryptPassword($password);

    if($password_hash = $db_password){
        return true;
    }else{
        return false;
    }

}


function sendVerificationEmail($email,$otp,$username)
{

    $template = file_get_contents(EMAIL_TEMPLATE_PATH);

    $fill = '<strong><span style="text-decoration: underline;">11</span> <span style="text-decoration: underline;">22</span> <span style="text-decoration: underline;">33</span> <span style="text-decoration: underline;">44</span> <span style="text-decoration: underline;">55</span> <span style="text-decoration: underline;">66</span></strong>';

    $otp_fill = $fill;

    $otp_fill = str_replace("11", substr($otp, 0, 1), $otp_fill);
    $otp_fill = str_replace("22", substr($otp, 1, 1), $otp_fill);
    $otp_fill = str_replace("33", substr($otp, 2, 1), $otp_fill);
    $otp_fill = str_replace("44", substr($otp, 3, 1), $otp_fill);
    $otp_fill = str_replace("55", substr($otp, 4, 1), $otp_fill);
    $otp_fill = str_replace("66", substr($otp, 5, 1), $otp_fill);

    $template = str_replace($fill, $otp_fill, $template);
    $template = str_replace("https://domain.com", BASE_URL, $template);

    $data = array(
        'to' => $email,
        'name' => $username,
        'subject' => "Here is your verification code for " . APP_NAME,
        'message' => $template
    );

    $result = Utility::sendMail($data);

    return $result;

}

?>