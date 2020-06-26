<?php

class OauthSdk
{
    public static function getAuthUrl(): array
    {
        $providersConfig = include "providers.php";

        $authUrls = [];

        $redirect_success_uri = $config["redirect_success"];
        
        $_SESSION["state"] = uniqid(). "_" . $config;
        
        $state = uniqid();
        $_SESSION["state"] = $state;

        foreach ($providersConfig as $provider => $config) {
            $state .= "_" . $provider;
            $authUrls[$provider] = $config["authUrl"] . "?response_type=code&client_id={$config["client_id"]}&state=$state&scope=email&redirect_uri={$redirect_success_uri}/success";
        }

        return $authUrls;
    }

    public static function callback()
    {
        $urlBaseToken = "http://oauth-server/token";

        $cient_secret = "0166fbd1fe07055241db5cd787e2cb3d0a46d44c";
        $client_id = "client_5ef3681b12cad1.72720600";

        ['code' => $code, 'state' => $rstate] = $_GET;
        
        $rstate = explode("_", $rstate);

        if ($_SESSION["state"] === $rstate[0]) {
            $tokenUrl = "{$urlBaseToken}?grant_type=authorization_code&code={$code}&client_id={$client_id}&client_secret={$cient_secret}";
            ['token' => $token] = json_decode(file_get_contents($tokenUrl), true);

            $urlBaseApi = "http://oauth-server/me";

            $rs = curl_init($urlBaseApi);
            curl_setopt_array($rs, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => 0,
                CURLOPT_HTTPHEADER => [
                    "Authorization: Bearer {$token}"
                ]
            ]);

            $resultArray = json_decode(curl_exec($rs));
            curl_close($rs);

            return $resultArray;
        }

        return null;
    }
}