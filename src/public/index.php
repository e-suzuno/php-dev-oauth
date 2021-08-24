<?php

/**
 * ログインへ遷移するページ
 */


use App\OAuth\OAuthFactory;

include_once __DIR__ . '/../vendor/autoload.php';

$oauth_credentials = __DIR__ . '/../config/client_secret.json';
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . "/profile.php";



$GoogleOAuth =(new OAuthFactory)->get("google");
$GoogleOAuth->setAuthConfigFile($oauth_credentials);
$GoogleOAuth->setRedirectUrl($redirect_uri);




?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>認証</title>
</head>
<body>


<div class="box">
    <a class='login' href='<?php echo $GoogleOAuth->getAuthUrl(); ?>'>Googleによるログイン</a>
</div>

</body>
</html>

