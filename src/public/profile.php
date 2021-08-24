<?php


/**
 * redirect後のページ
 * ユーザー情報の表示
 *
 */


use App\OAuth\OAuthFactory;

include_once __DIR__ . '/../vendor/autoload.php';


$oauth_credentials = __DIR__ . '/../config/client_secret.json';
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . "/profile.php";


$GoogleOAuth = (new OAuthFactory)->get("google");
$GoogleOAuth->setAuthConfigFile($oauth_credentials);
$GoogleOAuth->setRedirectUrl($redirect_uri);


if (!isset($_GET['code'])) {
    echo "error";
    exit;
}
$GoogleOAuth->setAuthorizationCode($_GET['code']);


$user = $GoogleOAuth->getUser();


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>profile</title>
</head>
<body>


<div class="box">
    <a href="index.php">top</a>

    <div class="profile">

        <div>
            service_type:
            <?php echo $user->service_type; ?>
        </div>
        <div>
            id:
            <?php echo $user->id; ?>
        </div>
        <div>
            thumbnail:
            <img src="<?php echo $user->thumbnail; ?>" alt="thumbnail">
        </div>
        <div>email:<?php echo $user->email; ?></div>
        <div>name:<?php echo $user->name; ?></div>
        <div>given_name:<?php echo $user->given_name; ?></div>
        <div>family_name:<?php echo $user->family_name; ?></div>
        <div>locale:<?php echo $user->locale; ?></div>
    </div>
</div>


</body>
</html>

