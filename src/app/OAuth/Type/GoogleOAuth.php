<?php

namespace App\OAuth\Type;


use App\OAuth\Entities\OAuthEntity;
use Google\Client;

/**
 * Class GoogleOAuth
 * @package App\OAuth\Type
 */
class GoogleOAuth implements OAuthTypeInterface
{

    /**
     * @var string
     */
    private string $service_type = "google";

    /**
     * @var string[]
     */
    private $scopes = [
        "https://www.googleapis.com/auth/userinfo.email",
        "https://www.googleapis.com/auth/userinfo.profile",
    ];

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var array
     */
    private array $token;


    /**
     * GoogleOAuth constructor.
     */
    public function __construct()
    {
        $this->client = $this->getClient();
        $this->client->addScope($this->scopes);
    }


    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return new Client();
    }


    /**
     * @param string $filepath
     */
    public function setAuthConfigFile(string $filepath): void
    {
        $this->client->setAuthConfig($filepath);
    }

    /**
     * @param string $url
     */
    public function setRedirectUrl(string $url): void
    {
        $this->client->setRedirectUri($url);
    }

    /**
     * @return string
     */
    public function getAuthUrl(): string
    {
        return $this->client->createAuthUrl();
    }


    /**
     * 認可コードのセット
     *
     * @param $code
     */
    public function setAuthorizationCode($code): void
    {
        $this->token = $this->client->fetchAccessTokenWithAuthCode($code);
    }

    public function getAccessToken()
    {
        return $this->token['access_token'];
    }

    /**
     * @return OAuthEntity
     */
    public function getUser(): OAuthEntity
    {
        $access_token = $this->getAccessToken();
        $googleUser = json_decode(
            file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?' . 'access_token=' . $access_token)
        );


        return new OAuthEntity(
            $this->service_type,
            $googleUser->id,
            $googleUser->name,
            $googleUser->email,
            $googleUser->given_name,
            $googleUser->family_name,
            $googleUser->locale,
            $googleUser->picture
        );
    }


}