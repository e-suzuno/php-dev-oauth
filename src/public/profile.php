<?php


/**
 * redirect後のページ
 * ユーザー情報の表示
 *
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


if (!isset($_GET['code'])) {
    echo "error";
    exit;
}


$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

$googleUser = json_decode(
    file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . 'access_token=' . $token['access_token'])
);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>profile</title>
</head>
<body>


<div class="box">

    <div class="profile">

        <div>
            id:
            <?php echo $googleUser->id; ?>
        </div>
        <div>
            picture:
            <img src="<?php echo $googleUser->picture; ?>" alt="picture">
        </div>
        <div>email:<?php echo $googleUser->email; ?></div>
        <div>name:<?php echo $googleUser->name; ?></div>
        <div>given_name:<?php echo $googleUser->given_name; ?></div>
        <div>family_name:<?php echo $googleUser->family_name; ?></div>
        <div>locale:<?php echo $googleUser->locale; ?></div>
    </div>
</div>


</body>
</html>

