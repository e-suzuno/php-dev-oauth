<?php

/**
 * ログインへ遷移するページ
 */



include_once __DIR__ . '/../vendor/autoload.php';

$oauth_credentials = __DIR__ . '/../config/client_secret.json';
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . "/profile.php";

$client = new Google\Client();
$client->setAuthConfig($oauth_credentials);
$client->setRedirectUri($redirect_uri);
$scopes = [
    "https://www.googleapis.com/auth/userinfo.email",
    "https://www.googleapis.com/auth/userinfo.profile",
];
$client->addScope($scopes);


$authUrl = $client->createAuthUrl();


?>

<div class="box">
    <div class="request">
        <a class='login' href='<?= $authUrl ?>'>Connect Me!</a>
    </div>
</div>

