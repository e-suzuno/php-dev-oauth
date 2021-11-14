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

$GoogleOAuth =(new OAuthFactory)->get("google" , config("oauth.google"));

if (!isset($_GET['code'])) {
    echo "error";
    exit;
}
$GoogleOAuth->setAuthorizationCode($_GET['code']);

$user = $GoogleOAuth->getUser();

$_SESSION['oauth_token'] = $GoogleOAuth->getAccessToken();
$_SESSION['oauth_type'] = OAuthFactory::GOOGLE;


header('Location: http://localhost/user.php');
