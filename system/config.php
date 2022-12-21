<?php

// enviroment variables
// administration
$email = getenv('ADMIN_EMAIL') ?? 'admin@easypanel.io';
$password = getenv('ADMIN_PASSWORD') ?? 'password';

// App
$appname = getenv('APP_NAME') ?? 'AnonUpload - Secure File Sharing';
$appdesc = getenv('APP_DESC') ?? 'Secure and anonymous file sharing';
$applogo = getenv('APP_LOGO_IMAGE') ?? 'assets/images/logo.png';

// Plausible analytics
$plausibledomain = getenv('PLAUSIBLE_DOMAIN');
$plausibledatadomain = getenv('PLAUSIBLE_DATA_DOMAIN');

// Uploader settings
$filelist = getenv('APP_FILELIST') ?? 'jpeg,jpg,gif,png,zip,xls,doc,mp3,mp4,mpeg,wav,avi,rar,7z,txt';
$sizeverification = getenv('APP_SIZE_VERIFICATION') ?? true;
$filedestination = getenv('APP_FILE_DESTINATION') ?? 'files';
$baseurl = getenv('APP_BASE_URL') ?? $_SERVER['HTTP_HOST'];
$maxsize = getenv('APP_MAX_SIZE') ?? (int)(ini_get('upload_max_filesize'));
$minsize = getenv('APP_MIN_SIZE') ?? '0';

define('email', $email);
define('password', $password);
define('app_name', $appname);
define('app_desc', $appdesc);
define('app_logoimage', $applogo);
define('FILELIST', $filelist);
define('size_verification', $sizeverification);
define('file_destination', $filedestination);
define('file_url_destination', $baseurl);
define('max_size', $maxsize);
define('min_size', $minsize);

// Plausible Analytics
define('plausibledomain', $plausibledomain);
define('plausibledatadomain', $plausibledatadomain);

?>
