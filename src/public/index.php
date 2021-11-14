<?php

/**
 * ログインへ遷移するページ
 */


include_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();
session_start();
oauth_session_reset();


use App\OAuth\OAuthFactory;

$GoogleOAuth = (new OAuthFactory)->get("google", config("oauth.google"));
$MicrosoftOAuth = (new OAuthFactory)->get("microsoft", config("oauth.microsoft"));


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>認証</title>
</head>
<body>


<div class="box">

    <ul>
        <li>

            <a class='login' href='<?php echo $GoogleOAuth->getAuthUrl(); ?>'>Googleによるログイン</a>
        </li>
        <li>
            <a class='login' href='<?php echo $MicrosoftOAuth->getAuthUrl(); ?>'>Microsoftによるログイン</a>
        </li>
    </ul>
</div>


</body>
</html>

