<?php

include_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();
session_start();


use App\OAuth\OAuthFactory;


$oauth_type = $_SESSION['oauth_type'];

$OAuth = (new OAuthFactory)->get($oauth_type, config("oauth." . $oauth_type));

$OAuth->setAccessToken($_SESSION['oauth_token']);
$user = $OAuth->getUser();


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

        <?php if ($user->thumbnail != ""): ?>
            <div>
                thumbnail:
                <img src="<?php echo $user->thumbnail; ?>" alt="thumbnail">
            </div>
        <?php endif; ?>
        <div>email:<?php echo $user->email; ?></div>
        <div>name:<?php echo $user->name; ?></div>
        <div>given_name:<?php echo $user->given_name; ?></div>
        <?php if ($user->family_name != ""): ?>
            <div>family_name:<?php echo $user->family_name; ?></div>
        <?php endif; ?>
        <?php if ($user->locale != ""): ?>
            <div>locale:<?php echo $user->locale; ?></div>
        <?php endif; ?>
    </div>
</div>


</body>
</html>

