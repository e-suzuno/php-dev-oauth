<?php


return [

    "oauth" => [
        "google" => [
            "client_id" => getenv("GOOGLE_CLIENT"),
            "client_secret" => getenv("GOOGLE_SECRET"),
            "redirect_uri" => getenv("GOOGLE_REDIRECT_URI")
        ],
        "microsoft" => [
            'scopes' => 'openid profile offline_access user.read email',
            "client_id" => getenv("MICROSOFT_CLIENT"),
            "client_secret" => getenv("MICROSOFT_SECRET"),
            "redirect_uri" => getenv("MICROSOFT_REDIRECT_URI"),
        ]
    ]
];
