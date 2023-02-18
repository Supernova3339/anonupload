<?php

// Get Configuration
require '../system/config.php';
// Get Dashboard URL
$url = $file_url_destination.'/admin/dashboard';
// (A) START SESSION
session_start();

// (B) HANDLE LOGIN
if (isset($_POST['user']) && !isset($_SESSION['user'])) {
    // (B1) USERS & PASSWORDS - SET YOUR OWN !
    $users = [
        email => password, //  USER AND PASSWORD PULLED FROM CONFIGURATION FILE
    ];

    // (B2) CHECK & VERIFY
    if (isset($users[$_POST['user']])) {
        // check captcha
        if ($_SESSION['captcha'] !== $_POST['captcha']) {
            header('Location: ?capfail');
            exit(0);
        }
        // end captcha
        if ($users[$_POST['user']] == $_POST['password']) {
            $_SESSION['user'] = $_POST['user'];
        }
    }

    // (B3) FAILED LOGIN FLAG
    if (!isset($_SESSION['user'])) {
        $failed = true;
    }
}

// (C) REDIRECT USER TO DASHBOARD IF SIGNED IN
if (isset($_SESSION['user'])) {
    header('Location: dashboard'); // REDIRECT TO DASHBOARD
    exit();
}
