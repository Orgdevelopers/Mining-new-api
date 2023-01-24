<?php

define('API_KEY', '115cds-9857-5789-4433-0011');
define('ADMIN_API_KEY', '115cds-9857-5789-4433-0011');


date_default_timezone_set('Asia/Karachi');
define('BASE_URL', 'https://zfm-group.com/mobileapi/');
define('APP_STATUS', 'live');///demo/live
define('APP_NAME', 'Test');
define('TEAM_NAME', "App name Team");

define('ADMIN_RECORDS_PER_PAGE',20);
define('APP_RECORDS_PER_PAGE',20);


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

define('UPLOADS_FOLDER_URI', 'webroot/uploads');
define('TEMP_UPLOADS_FOLDER_URI', 'webroot/temp_uploads');
define('FONT_FOLDER_URI', 'webroot/font');


?>