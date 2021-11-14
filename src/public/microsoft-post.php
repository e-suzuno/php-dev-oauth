<?php


/**
 * redirect後のページ
 * ユーザー情報の表示
 *
 */

include_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();
session_start();


use App\OAuth\OAuthFactory;


$MicrosoftOAuth = (new OAuthFactory)->get("microsoft", config("oauth.microsoft"));
// Validate state

$oauthState = $_SESSION['oauthState'];
unset($_SESSION['oauthState']);

if (!isset($_GET['code'])) {
    echo "error";
    exit;
}

$MicrosoftOAuth->setAuthorizationCode($_GET['code']);

$user = $MicrosoftOAuth->getUser();

$_SESSION['oauth_token'] = $MicrosoftOAuth->getAccessToken();
$_SESSION['oauth_type'] = OAuthFactory::MICROSOFT;


header('Location: http://localhost/user.php');
