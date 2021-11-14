<?php


/**
 * @param string|null $path
 * @return array|mixed|void
 */
function config(string $path = null)
{
    $config = include __DIR__ . '/../config/config.php';
    if (is_null($path)) {
        return $config;
    }
    return array_get($config, $path);
}



/**
 * @param array $array
 * @param $path
 * @param string $separator
 * @return array|mixed|void
 */
function array_get(array $array, $path, string $separator = '.')
{
    $keys = explode($separator, $path);
    $current = $array;
    foreach ($keys as $key) {
        if (!isset($current[$key])) return;
        $current = $current[$key];
    }
    return $current;
}


function oauth_session_reset(){
    unset($_SESSION['code']);
    unset($_SESSION['oauth_token']);
    unset($_SESSION['oauth_type']);
    unset($_SESSION['oauthState']);
}

