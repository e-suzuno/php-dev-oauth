<?php


namespace App\OAuth;


use App\OAuth\Type\GoogleOAuth;
use App\OAuth\Type\OAuthTypeInterface;


/**
 * Class OAuthFactory
 * @package App\OAuth
 */
class OAuthFactory
{

    /**
     * @var string[]
     */
    public static $OAauhType = [
        "google" => GoogleOAuth::class
    ];


    /**
     * @param string $type
     * @return OAuthTypeInterface|null
     */
    public static function get(string $type) : ?OAuthTypeInterface
    {
        if (!isset(self::$OAauhType[$type])) {
            return null;
        }

        return (new self::$OAauhType[$type]);

    }

}