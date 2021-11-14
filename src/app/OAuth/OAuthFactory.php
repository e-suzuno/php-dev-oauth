<?php


namespace App\OAuth;


use App\OAuth\Type\GoogleOAuth;
use App\OAuth\Type\MicrosoftOAuth;
use App\OAuth\Type\OAuthTypeInterface;


/**
 * Class OAuthFactory
 * @package App\OAuth
 */
class OAuthFactory
{

    const GOOGLE = "google";

    const MICROSOFT = "microsoft";

    /**
     * @var string[]
     */
    public static array $OAauhType = [
        self::GOOGLE => GoogleOAuth::class,
        self::MICROSOFT => MicrosoftOAuth::class
    ];


    /**
     * @param string $type
     * @param array $config
     * @return OAuthTypeInterface
     * @throws \Exception
     */
    public static function get(string $type, array $config = []): OAuthTypeInterface
    {
        if (!isset(self::$OAauhType[$type])) {
            throw new \Exception("OAuthFactory Error. Non-existent type:$type");
        }

        return (new self::$OAauhType[$type]($config));

    }

}