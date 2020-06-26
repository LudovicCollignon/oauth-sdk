<?php

session_start();
include "OauthSdk.php";

function register() 
{
    
}

function home()
{
    $authUrls = OauthSdk::getAuthUrl();

    echo "<a href=\"{$authUrls["oauth-server"]}\">Se connecter via OauthServer</a>";
}

function authSucess()
{
    var_dump(OauthSdk::callback());
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
    case '/register':
        register();
        break;
}
