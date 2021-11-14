<?php

namespace App\OAuth\Type;


use App\OAuth\Entities\OAuthEntity;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model\User as MicrosoftUser;

/**
 *
 */
class MicrosoftOAuth implements OAuthTypeInterface
{

    /**
     * @var string
     */
    private string $service_type = "microsoft";


    /**
     * @var array
     */
    private mixed $token;
    private string $redirect_uri;
    private mixed $client_id;
    private mixed $scopes;
    private mixed $client_secret;


    /**
     * GoogleOAuth constructor.
     */
    public function __construct($config = [])
    {
        $this->setRedirectUrl($config['redirect_uri']);
        $this->client_id = $config['client_id'];
        $this->scopes = $config['scopes'];
        $this->client_secret = $config['client_secret'];
    }


    public function getOauthClient()
    {
        $oauthClient = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => $this->client_id,
            'clientSecret' => $this->client_secret,
            'redirectUri' => $this->redirect_uri,
            'urlAuthorize' => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
            'urlAccessToken' => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => '',
            'scopes' => $this->scopes,
        ]);
        return $oauthClient;
    }


    /**
     * @param string $url
     */
    public function setRedirectUrl(string $url): void
    {
        $this->redirect_uri = $url;
    }


    /**
     * @return string
     */
    public function getAuthUrl(): string
    {

        $oauthClient = $this->getOauthClient();
        $authUrl = $oauthClient->getAuthorizationUrl();

        $_SESSION['oauthState'] = $oauthClient->getState();

        return $authUrl;

    }


    /**
     * 認可コードのセット
     *
     * @param $code
     */
    public function setAuthorizationCode($code): void
    {
        $oauthClient = $this->getOauthClient();
        $accessToken = $oauthClient->getAccessToken('authorization_code', [
            'code' => $code
        ]);
        $this->setAccessToken($accessToken);
    }


    /**
     * @param $token
     */
    public function setAccessToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getAccessToken(): mixed
    {
        return $this->token;
    }

    /**
     * @return OAuthEntity
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Microsoft\Graph\Exception\GraphException
     */
    public function getUser(): OAuthEntity
    {
        $accessToken = $this->getAccessToken();
        $graph = new Graph();
        $graph->setAccessToken($accessToken);

        $user = $graph->createRequest('GET', '/me?$select=displayName,mail,mailboxSettings,userPrincipalName')
            ->setReturnType(MicrosoftUser::class)
            ->execute();


        /**
         * @var $user MicrosoftUser
         */


        return new OAuthEntity(
            $this->service_type,
            $user->getId(),
            $user->getDisplayName(),
            $user->getMail() ?? $user->getUserPrincipalName() ?? "",
            $user->getGivenName(),
            "",
            $user->getUsageLocation() ?? "",
            "",
        );

    }


}