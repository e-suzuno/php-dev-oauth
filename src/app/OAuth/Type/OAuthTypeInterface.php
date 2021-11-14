<?php

namespace App\OAuth\Type;


use App\OAuth\Entities\OAuthEntity;

/**
 * Interface OAuthTypeInterface
 * @package App\OAuth\Type
 */
interface OAuthTypeInterface
{

    /**
     * リダイレクト先のURLを設定する。
     *
     * @param string $url
     */
    public function setRedirectUrl(string $url): void;

    /**
     * 認証ページのURLを取得する。
     *
     * @return string
     */
    public function getAuthUrl(): string;


    /**
     * 認可コードの設定
     * @param $code
     */
    public function setAuthorizationCode($code): void;


    /**
     * アクセストークンのセット
     */
    public function setAccessToken($token): void;


    /**
     * アクセストークンの取得
     */
    public function getAccessToken(): mixed;



    /**
     * ユーザー情報の取得
     * @return OAuthEntity
     */
    public function getUser(): OAuthEntity;

}