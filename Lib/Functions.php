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

    $template = file_get_contents(VERIFICATION_EMAIL_TEMPLATE_PATH);

    $otp_fill = str_replace("!1!", substr($otp, 0, 1), $template);
    $otp_fill = str_replace("!2!", substr($otp, 1, 1), $otp_fill);
    $otp_fill = str_replace("!3!", substr($otp, 2, 1), $otp_fill);
    $otp_fill = str_replace("!4!", substr($otp, 3, 1), $otp_fill);
    $otp_fill = str_replace("!5!", substr($otp, 4, 1), $otp_fill);
    $otp_fill = str_replace("!6!", substr($otp, 5, 1), $otp_fill);

    $otp_fill = str_replace("!base_url!", BASE_URL, $otp_fill);
    $otp_fill = str_replace("!username!", $username, $otp_fill);
    $otp_fill = str_replace("!app_name!", APP_NAME, $otp_fill);
    $otp_fill = str_replace("!team_name!", TEAM_NAME, $otp_fill);


    $data = array(
        'to' => $email,
        'name' => $username,
        'subject' => "Here is your verification code for " . APP_NAME,
        'message' => $template
    );

    $result = Utility::sendMail($data);

    return $result;

}


function sendWelcomeEmail($email,$username,$user_id){
    $template = file_get_contents(WELCOME_EMAIL_TEMPLATE_PATH);

    $verification_link = API_URL."verifyEmail?token".Utility::EncryptPassword($user_id);

    $template = str_replace("!base_url!", BASE_URL, $template);
    $template = str_replace("!username!", $username, $template);
    $template = str_replace("!app_name!", APP_NAME, $template);
    $template = str_replace("!team_name!", TEAM_NAME, $template);
    $template = str_replace("!verification_link!", $verification_link, $template);

    $data = array(
        'to' => $email,
        'name' => $username,
        'subject' => "Welcome Email",
        'message' => $template
    );

    $mm = Utility::sendMail($data);
    return $mm;

}

?>