<?php

    $code = $_SERVER['REDIRECT_STATUS'];
    $codes = [
        403 => 'Forbidden',
        404 => '404 Not Found',
        500 => 'Internal Server Error',
    ];
    $source_url = 'http'.((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    if (array_key_exists($code, $codes) && is_numeric($code)) {
        exit("Error $code: {$codes[$code]}");
    } else {
        exit('Unknown error');
    }
