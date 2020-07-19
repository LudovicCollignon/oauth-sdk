# oauth-sdk

## Config

In providers.php file, add providers config like this :

```
"github" => [
        "client_id" => "",
        "client_secret" => "",
        "authUrl" => "https://github.com/login/oauth/authorize",
        "url_token" => "https://github.com/login/oauth/access_token",
        "url_api" => "https://api.github.com/user",
        "scope" => "email",
        "redirect_success" => "",
        "redirect_error" => "",
        "token_key" => "access_token"]
```

## Usage

Create an OauthSdk instance and get list of urls. Use the keys in providers.php file to get a specific url :

```
$authUrls = (new OauthSdk())->getAuthUrl();

echo "<a href='{$authUrls['oauth-server']}'>Log in with OauthServer</a>";
echo "<a href='{$authUrls['github']}'>Log in with Github</a>";
```

Use the call back method redirect in the success route of your app :

```
(new OauthSdk())->callback();
```
