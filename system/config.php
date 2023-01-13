<?php

// enviroment variables
// administration
$email = getenv('ADMIN_EMAIL') ?? 'admin@easypanel.io';
$password = getenv('ADMIN_PASSWORD') ?? 'password';

// App
$appname = getenv('APP_NAME') ?? 'AnonUpload - Secure File Sharing';
$appdesc = getenv('APP_DESC') ?? 'Secure and anonymous file sharing';
$applogo = getenv('APP_LOGO_IMAGE') ?? 'assets/images/logo.png';
$appcontact = getenv('APP_CONTACT_EMAIL');

// Plausible analytics
$plausibledomain = getenv('PLAUSIBLE_DOMAIN');
$plausibledatadomain = getenv('PLAUSIBLE_DATA_DOMAIN');
$plausibleembed = getenv('PLAUSIBLE_EMBED');
$plausibleembedtoken = getenv('PLAUSIBLE_EMBED_TOKEN');

// Uploader settings
$filelist = getenv('APP_FILELIST') ?? 'jpeg,jpg,gif,png,zip,xls,doc,mp3,mp4,mpeg,wav,avi,rar,7z,txt';
$sizeverification = getenv('APP_SIZE_VERIFICATION') ?? true;
$filedestination = getenv('APP_FILE_DESTINATION') ?? 'files';
$baseurl = getenv('APP_BASE_URL') ?? $_SERVER['HTTP_HOST'];
$maxsize = getenv('APP_MAX_SIZE') ?? (int)(ini_get('upload_max_filesize'));
$minsize = getenv('APP_MIN_SIZE') ?? '0';

$waitfor = getenv('APP_DOWNLOAD_TIME');

define('email', $email);
define('password', $password);

/* SEO */
define('app_name', $appname);
define('app_desc', $appdesc);

/* Upload Settings */
define('app_logoimage', $applogo);
define('FILELIST', $filelist);
define('size_verification', $sizeverification);
define('file_destination', $filedestination);
define('file_url_destination', $baseurl);
define('max_size', $maxsize);
define('min_size', $minsize);
define('app_contact_email', $appcontact);
define('waitfor', $waitfor);

/* Analytics */
define('plausibledomain', $plausibledomain);
define('plausibledatadomain', $plausibledatadomain);
define('plausible_embed', $plausibleembed);
define('plausibleembedtoken', $plausibleembedtoken);
/* version */
define('version', 'v1.0.0'); // DO NOT FORGET TO CHANGE THIS
$github_api_url = "https://api.github.com/repos/Supernova3339/anonupload/releases/latest"; // this is how tag gets pulled for latest version


?>
