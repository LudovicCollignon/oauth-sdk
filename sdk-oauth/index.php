<?php

session_start();
include "OauthSdk.php";

function home()
{
    $authUrls = (new OauthSdk())->getAuthUrl();

    echo "<a href='{$authUrls['oauth-server']}'>Se connecter via OauthServer</a><br><br>";
    echo "<a href='{$authUrls['amazon']}'>Se connecter via Amazon</a><br><br>";
    echo "<a href='{$authUrls['github']}'>Se connecter via Github</a><br><br>";
}

function authSucess()
{
    var_dump((new OauthSdk())->callback());
}

// Router
$route = strtok($_SERVER['REQUEST_URI'], '?');
switch ($route) {
    case '/':
        home();
        break;
    case '/success':
        authSucess();
        break;
}