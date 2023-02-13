<?php

define('API_KEY', '115cds-9857-5789-4433-0011');
define('ADMIN_API_KEY', '115cds-9857-5789-4433-0011');
define('FIREBASE_PUSH_NOTIFICATION_KEY', 'AAAAQka6olY:APA91bE2WzdQRJK0q_LYllIc2IiadvVCBDeMTGG2e-qHzOc4vMjQhhUfnopdDjehDY40zSRiHaHp6j-YNKB0LOEY_mqQ7qztQdxJsnuqwJ8v_HhaWuaDNDVpSHb-8qLvQNf9AEtO8RdP');

date_default_timezone_set('Asia/Karachi');
define('BASE_URL', 'https://hosting.tiktalkvideo.online/');
define('API_URL', BASE_URL . "api/");
define('APP_STATUS', 'live');///demo/live
define('APP_NAME', 'Test');
define('TEAM_NAME', "App name Team");

define('ADMIN_RECORDS_PER_PAGE',15);
define('APP_RECORDS_PER_PAGE',10);

//NOTIFICATION STRINGS

define('CONGRATULATIONS', 'Congratulations');
define('FREE_TRIAL_ACTIVATED', 'Your free trial has been activated successfully');

define('ENERGEY_REFILLED', 'Your mining energey has been refilled');
define('ENERGEY_REFILLED_BODY', 'Go and start mining now');


define('MINING_EXPIRED', "Mining Server Expired");
define('MINING_EXPIRED_BODY', "Your mining server has been expired. Renew or Purchase new Server to continue mining");
define('WITHDRAW_REQUEST_REGISTERED', "Your withdraw request has been registered successfully. You will receive payment in your account within 24-48 working hours");

define('PLAN_PURCHASED_TITLE', CONGRATULATIONS . "");
define('PLAN_PURCHASED_BODY', 'You have successfully purchased %p_n% Server.'); // %p_n% will be replaced by server name by api;

//define(;)

define('ENERGEY_RECHARGE_RATE', 20); //per min

define('DATABASE_HOST', 'localhost');
define('DATABASE_USER', 'host_min');
define('DATABASE_PASSWORD', 'host_min');
define('DATABASE_NAME', 'host_min');



define('MAIL_HOST', "zfm-group.com");
define('MAIL_USERNAME', "no-reply@zfm-group.com");
define('MAIL_PASSWORD', "no-reply@zfm-group.com");
define('MAIL_FROM', "no-reply@zfm-group.com"); //apps mail address ex app@domain.com
define('MAIL_NAME', "TestEmail"); //app name
define('MAIL_REPLYTO', "no-reply@zfm-group.com");


define('VERIFICATION_EMAIL_TEMPLATE_PATH', 'Templates/VerificationEmail.html');
define('WELCOME_EMAIL_TEMPLATE_PATH', 'Templates/WelcomEmail.html');
define('EMAIL_VERIFIED_TEMPLATE','Templates/EmailVerified.html' );

define('UPLOADS_FOLDER_URI', 'webroot/uploads/');
define('IMAGE_UPLOAD_FOLDER', 'webroot/uploads/img/');
define('FONT_FOLDER_URI', 'webroot/font');


?>