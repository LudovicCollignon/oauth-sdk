<?php

return [
    "oauth-server" => [
        "client_id" => "client_5f10b9beca4173.18886383",
        "client_secret" => "adb8c5e50026a02753c1963b0b298431f469bb78",
        "authUrl" => "http://localhost:7070/auth",
        "url_token" => "http://oauth-server/token",
        "url_api" => "http://oauth-server/me",
        "scope" => "email",
        "redirect_success" => "http://localhost:7071/success",
        "redirect_error" => "http://localhost:7071/error",
        "token_key" => "token"
    ],
    "amazon" => [
        "client_id" => "amzn1.application-oa2-client.a4cf9f134ad54fca8667434c30e584e6",
        "client_secret" => "266e2a24a203ecabba10b9e79cc8062591afce8d83513a4734fbb988a065f481",
        "authUrl" => "https://www.amazon.com/ap/oa",
        "url_token" => "https://api.amazon.com/auth/o2/token",
        "url_api" => "https://api.amazon.com/user/profile",
        "scope" => "profile",
        "redirect_success" => "http://localhost:7071/success",
        "redirect_error" => "http://localhost:7071/error",
    ],
    "facebook" => [
        "client_id" => "587530831899920",
        "client_secret" => "39e60e3334f17498cccad0864e964147",
        "authUrl" => "https://www.facebook.com/v7.0/dialog/oauth",
        "url_token" => "https://graph.facebook.com/v7.0/oauth/access_token",
        "url_api" => "https://api.amazon.com/user/profile",
        "scope" => "email",
        "redirect_success" => "http://localhost:7071/success",
        "redirect_error" => "http://localhost:7071/error",
    ],
    "github" => [
        "client_id" => "8145161a8ac6ead7bd16",
        "client_secret" => "eae36b054c9aac5527aa2b18c32c1eb6c5a40c8f",
        "authUrl" => "https://github.com/login/oauth/authorize",
        "url_token" => "https://github.com/login/oauth/access_token",
        "url_api" => "https://api.github.com/user",
        "scope" => "email",
        "redirect_success" => "http://localhost:7071/success",
        "redirect_error" => "http://localhost:7071/error",
        "token_key" => "access_token",
    ],
];