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

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>認証</title>
</head>
<body>


<div class="box">
    <a class='login' href='<?php echo $client->createAuthUrl(); ?>'>Googleによるログイン</a>
</div>

</body>
</html>

