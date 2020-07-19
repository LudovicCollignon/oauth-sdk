<?php 

class OauthSdk
{
    public function getAuthUrl(): array
    {
        $providersConfig = include "providers.php";

        $authUrls = [];

        $state = uniqid();
        $_SESSION["state"] = $state;

        foreach ($providersConfig as $provider => $config) {

            $stateUrl = $state . "_" . $provider;

            $authUrls[$provider] = $config["authUrl"] . "?response_type=code&client_id={$config["client_id"]}&state={$stateUrl}&scope={$config["scope"]}&redirect_uri={$config["redirect_success"]}";
        }

        return $authUrls;
    }

    public function callback()
    {
        ['code' => $code, 'state' => $state] = $_GET;

        $rstate = explode("_", $state);

        $provider = $rstate[1];

        $config = $this->getConfig($provider);

        if ($_SESSION["state"] === $rstate[0]) {

            // var_dump($config);die;
            $token = $this->getToken($provider, $code, $state, $config);

            $rs = curl_init();
            curl_setopt_array($rs, [
                CURLOPT_URL => $config["url_api"],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERAGENT => 'OauthTest',
                CURLOPT_HTTPHEADER => [
                    "Accept: application/json",
                    "Authorization: Bearer $token"
                ]
            ]);
            $resultArray = json_decode(curl_exec($rs));
            curl_close($rs);

            return $resultArray;
        }

        return null;
    }

    private function getToken(string $provider, string $code, string $state, array $config)
    {
        $token = '';
        $token_key = $config["token_key"];

        switch ($provider) {
            case 'oauth-server':
                $tokenUrl = "{$config["url_token"]}?grant_type=authorization_code&code={$code}&client_id={$config["client_id"]}&client_secret={$config["client_secret"]}";
                [$token_key => $token] = json_decode(file_get_contents($tokenUrl), true);
                break;

            default:
                $params = [
                    "client_id" => $config["client_id"],
                    "client_secret" => $config["client_secret"],
                    "code" => $code,
                    "redirect_uri" => $config["redirect_success"],
                    "state" => $state,
                ];

                $rs = curl_init($config["url_token"]);
                curl_setopt_array($rs, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => $params,
                    CURLOPT_HTTPHEADER => ["Accept: application/json"],
                ]);

                $result = json_decode(curl_exec($rs));
                curl_close($rs);
                $token = $result->$token_key;
                break;
        }

        return $token;
    }

    private function getConfig($provider): array
    {
        $providersConfig = include "providers.php";
        $config = $providersConfig[$provider];

        return $config;
    }
}