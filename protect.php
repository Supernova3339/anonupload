<?php
$LOGIN_INFORMATION = [
    'user'  => 'userpass',
    'admin' => 'adminpass',
];
define('USE_USERNAME', true);
define('LOGOUT_URL', 'https://dl.supers0ft.us/logout.php/');
define('TIMEOUT_MINUTES', 0);
define('TIMEOUT_CHECK_ACTIVITY', true);
if (isset($_GET['help'])) {
    exit('Include following code into every page you would like to protect, at the very beginning (first line):<br>&lt;?php include("'.str_replace('\\', '\\\\', __FILE__).'"); ?&gt;');
}
$timeout = (TIMEOUT_MINUTES == 0 ? 0 : time() + TIMEOUT_MINUTES * 60);
if (isset($_GET['logout'])) {
    setcookie('verify', '', $timeout, '/');
    header('Location: '.LOGOUT_URL);
    exit();
}
if (!function_exists('showLoginPasswordProtect')) {
    function showLoginPasswordProtect($error_msg)
    {
        ?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Panel - Login</title>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Admin Panel - Dashboard">
<meta name="author" content="Supernova Software">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="apple-touch-icon" sizes="57x57" href="img/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
<link rel="manifest" href="img/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="img/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<link rel="stylesheet" type="text/css" media="screen" href="assets/login.css" />
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;700&display=swap" rel="stylesheet">


<div class="boxmain">
<div class="boxone">
<p><b>Admin Login</b></p></div>
<style>
input { border: 1px solid black; }
</style>
<div style="width:500px; margin-left:auto; margin-right:auto; text-align:center">
<form method="post">
<div class="boxinvite">
<p><b> Administration Panel</b></p></div>
<div class="errmessage">
<font color="#2f80ed"><?php echo $error_msg; ?></font></div>
<?php if (USE_USERNAME) {
            echo '<span class="login"></span><br /><input type="input" placeholder="Username" name="access_login" /><br /><span class="pass"></span><br />';
        } ?>
<input type="password" placeholder="Password" name="access_password" /><p></p>
<div class="buttonlogin"><input type="submit" name="join" value="🔒" /></div>
</form>

<!--End HTML, PHP and JavaScript.-->

<!--Login query.-->
<?php
exit();
    }
}
if (isset($_POST['access_password'])) {
    $login = isset($_POST['access_login']) ? $_POST['access_login'] : '';
    $pass = $_POST['access_password'];
    if (!USE_USERNAME && !in_array($pass, $LOGIN_INFORMATION)
|| (USE_USERNAME && (!array_key_exists($login, $LOGIN_INFORMATION) || $LOGIN_INFORMATION[$login] != $pass))
) {
        showLoginPasswordProtect('Incorrect data.');
    } else {
        setcookie('auth', md5($login.'%'.$pass), $timeout, '/');
        unset($_POST['access_login']);
        unset($_POST['access_password']);
        unset($_POST['Submit']);
    }
} else {
    if (!isset($_COOKIE['auth'])) {
        showLoginPasswordProtect('');
    }
    $found = false;
    foreach ($LOGIN_INFORMATION as $key=>$val) {
        $lp = (USE_USERNAME ? $key : '').'%'.$val;
        if ($_COOKIE['auth'] == md5($lp)) {
            $found = true;
            if (TIMEOUT_CHECK_ACTIVITY) {
                setcookie('auth', md5($lp), $timeout, '/');
            }
            break;
        }
    }
    if (!$found) {
        showLoginPasswordProtect('');
    }
}
?>