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
     * 設定ファイルのパスを指定する。
     *
     * @param string $filepath
     */
    public function setAuthConfigFile(string $filepath): void;

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
     * ユーザー情報の取得
     * @return OAuthEntity
     */
    public function getUser(): OAuthEntity;

}