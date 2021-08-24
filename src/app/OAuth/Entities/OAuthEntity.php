<?php

namespace App\OAuth\Entities;


/**
 * Class OAuthEntity
 * @package App\OAuth\Entities
 */
class OAuthEntity
{


    public string $service_type;
    public string $id;
    public string $name;
    public string $email;
    public string $given_name;
    public string $family_name;
    public string $locale;
    public string $thumbnail;


    public function __construct(
        string $service_type,
        string $id,
        string $name,
        string $email,
        string $given_name,
        string $family_name,
        string $locale,
        string $thumbnail
    )
    {
        $this->service_type = $service_type;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->given_name = $given_name;
        $this->family_name = $family_name;
        $this->locale = $locale;
        $this->thumbnail = $thumbnail;
    }


}