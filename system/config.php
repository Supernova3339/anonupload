<?php

// enviroment variables
// administration
$email = getenv('ADMIN_EMAIL') or 'admin@easypanel.io';
$password = getenv('ADMIN_PASSWORD') or 'password';

// App
$appname = getenv('APP_NAME') or 'AnonUpload - Secure File Sharing';
$appdesc = getenv('APP_DESC') or 'Secure and anonymous file sharing';
$applogo = getenv('APP_LOGO_IMAGE') or 'assets/images/logo.png';

// Plausible analytics
$plausible = getenv('PLAUSIBLE_DOMAIN');

// Uploader settings
$filelist = getenv('APP_FILELIST') or 'jpeg,jpg,gif,png,zip,xls,doc,mp3,mp4,mpeg,wav,avi,rar,7z,txt';
$sizeverification = getenv('APP_SIZE_VERIFICATION') or true;
$filedestination = getenv('APP_FILE_DESTINATION') or 'files';
$baseurl = getenv('APP_BASE_URL') or $_SERVER['HTTP_HOST'];
$maxsize = getenv('APP_MAX_SIZE') or (int)(ini_get('upload_max_filesize'));
$minsize = getenv('APP_MIN_SIZE') or '0';

define('email', $email);
define('password', $password);
define('app_name', $appname);
define('app_desc', $appdesc);
define('FILELIST', $filelist);
define('size_verification', $sizeverification);
define('file_destination', $filedestination);
define('file_url_destination', $baseurl);
define('max_size', $maxsize);
define('min_size', $minsize);

// Plausible Analytics
define('plausible', $plausible);

?>
