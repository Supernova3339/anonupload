<?php

// Get the code
$code = isset($_GET['code']) ? $_GET['code'] : '';

// If the code isn't in the correct format, CloudFlare will throw a 1020
if (!preg_match('/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12}) *$/i', $code)) {
    http_response_code(403);
    echo 'error code: 1020';
    exit;
}

header('Content-Type: application/json; charset=utf-8');

// Handle valid codes
if ($code == '86781236-23d0-4b3c-7dfa-c1c147e0dece') {
    echo <<<'EOD'
{
  "amount": "19.84",
  "sold_at": "2016-09-07T10:54:28+10:00",
  "license": "Regular License",
  "support_amount": "0.00",
  "supported_until": "9999-03-09T01:54:28+11:00",
  "item": {
    "id": 17022701,
    "name": "AnonUpload - Secure and anonymous file sharing",
    "author_username": "Supernova3339",
    "updated_at": "2017-11-02T15:57:41+11:00",
    "site": "codecanyon.net",
    "price_cents": 2000,
    "published_at": "2016-07-13T19:07:03+10:00"
  },
  "buyer": "test",
  "purchase_count": 1
}
EOD;
}

// Handle invalid codes
else {
    http_response_code(404);
    echo <<<'EOD'
{
	"error": 404,
	"description": "No sale belonging to the current user found with that code"
}
EOD;
}
