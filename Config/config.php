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
define('ENERGEY_RECHARGE_RATE', 20); //per min
define('REFERRAL_SIGNUP_REWARD',10); //only int supported, 100Tp = 1$
define('REFERRAL_PLAN_PUCHASE_REWARD',500);
define('APP_CURRENCY_NAME','TP');


//NOTIFICATION STRINGS
/*
 * You can change notification messages/languages etc from here
 * note :- don't change %% values like %u_n%, %p_n% these will be replaced by real values in runtime
 *  */

define('CONGRATULATIONS', 'Congratulations');
define('FREE_TRIAL_ACTIVATED', 'Your free trial has been activated successfully');

define('ENERGEY_REFILLED', 'Your mining energey has been refilled');
define('ENERGEY_REFILLED_BODY', 'Go and start mining now');


define('MINING_EXPIRED', "Mining Server Expired");
define('MINING_EXPIRED_BODY', "Your mining server has been expired. Renew or Purchase new Server to continue mining");
define('WITHDRAW_REQUEST_REGISTERED', "Your withdraw request has been registered successfully. You will receive payment in your account within 24-48 working hours");

define('PLAN_PURCHASED_TITLE', CONGRATULATIONS . "");
define('PLAN_PURCHASED_BODY', 'You have successfully purchased %p_n% Server.'); // %p_n% will be replaced by server name by api;


//on plan purchase request accepted
define('PLAN_PURCHASE_REQUEST_ACCEPTED_HEAD', CONGRATULATIONS . " Purchase verified successfully");
define('PLAN_PURCHASE_REQUEST_ACCEPTED_BODY', 'You have successfully purchased %p_n% Server.'); // %p_n% will be replaced by server name by api;


//on plan purchase request rejected
define('PLAN_PURCHASE_REQUEST_REJECTED_HEAD', "Server Purchase verification failed");
define('PLAN_PURCHASE_REQUEST_REJECTED_BODY', 'Your purchase request for %p_n% has been rejected'); // %p_n% will be replaced by server name by api;


//referral
define('REFERRAL_HEAD',CONGRATULATIONS." You received referral bonus %a_m%"); // %a_m% => amount
define('REFERRAL_BODY','%u_n% has just joined '.APP_NAME.' via your referral. you received %a_m% bouns'); //%u_n%


define('REFERRAL_PLAN_PURCHASE_HEAD',CONGRATULATIONS." You received Referral bonus"); // %a_m% => amount
define('REFERRAL_PLAN_PURCHASE_BODY','%u_n% has just Upgraded mining server. you received %a_m% bouns'); //%u_n% = username , %d_am% => doller amount

define('INVESTMENT_RETURN_HEAD',CONGRATULATIONS.'');
define('INVESTMENT_RETURN_BODY','Investment id %i_n% has been completed successfully. %a_m% interest has been added to your Invest Wallet');

define('WITHDRAW_SUCCESS_HEAD',CONGRATULATIONS.'');
define('WITHDRAW_SUCCESS_BODY','Your withdraw request for %a_m% has been accepted. The amount has been sent to your connected payout method');


define('WITHDRAW_FAIL_HEAD','Cancellation of Withdrawal notice');
define('WITHDRAW_FAIL_BODY','Your withdraw request for %a_m% has been cancelled. The amount has been returned to your wallet');


define('TASK_REQUEST_ACCEPT_HEAD',CONGRATULATIONS.', Task completed successfully');
define('TASK_REQUEST_ACCEPT_BODY','You have earned %t_p% worth %a_m%');


define('TASK_REQUEST_REJECT_HEAD','Task Request Cancellation notice');
define('TASK_REQUEST_REJECT_BODY','Your task request has been rejected');

//investment purchase request rejected
define('INV_PURCHASE_REQUEST_REJECTED_HEAD','Investment Puchase Cancellation notice');
define('INV_PURCHASE_REQUEST_REJECTED_BODY','Your Puchase request for investment plan %p_n% has been rejected');


define('INV_PURCHASE_REQUEST_ACCEPTED_HEAD', CONGRATULATIONS.'');
define('INV_PURCHASE_REQUEST_ACCEPTED_BODY','Your investment request for amount %a_m% for Investment plan %p_n% has been accepted');

//define(;)


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