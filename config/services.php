<?php


$servername = "127.0.0.1";
$username = "root";
$password = "qwerty123";
$db = "icodb";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

//$result = $conn->query('SELECT * FROM global_config')->fetch_all();



//dump($result);
//dump($conn->error_list);
$whitelist = array('127.0.0.1', "::1");
if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    $google_app_id = $conn->query("SELECT value FROM global_config WHERE name LIKE '%GOOGLE_OAUTH_APP_ID%'")->fetch_row();
    $google_app_secret = $conn->query("SELECT value FROM global_config WHERE name LIKE '%GOOGLE_OAUTH_APP_SECRET%'")->fetch_row();
    $google_app_redirect_url = $conn->query("SELECT value FROM global_config WHERE name LIKE '%GOOGLE_OAUTH_APP_REDIRECT_URL%'")->fetch_row();

    $facebook_app_id = $conn->query("SELECT value FROM global_config WHERE name LIKE '%FACEBOOK_CLIENT_ID%'")->fetch_row();
    $facebook_app_secret = $conn->query("SELECT value FROM global_config WHERE name LIKE '%FACEBOOK_CLIENT_SECRET%'")->fetch_row();
    $facebook_app_redirect_url = $conn->query("SELECT value FROM global_config WHERE name LIKE '%FACEBOOK_CLIENT_CALLBACK%'")->fetch_row();

    $github_app_id = $conn->query("SELECT value FROM global_config WHERE name LIKE '%GITHUB_OAUTH_APP_ID%'")->fetch_row();
    $github_app_secret = $conn->query("SELECT value FROM global_config WHERE name LIKE '%GITHUB_OAUTH_APP_SECRET%'")->fetch_row();
    $github_app_redirect_url = $conn->query("SELECT value FROM global_config WHERE name LIKE '%GITHUB_OAUTH_APP_REDIRECT_URL%'")->fetch_row();

    $twitter_app_id = $conn->query("SELECT value FROM global_config WHERE name LIKE '%TWITTER_OAUTH_APP_ID%'")->fetch_row();
    $twitter_app_secret = $conn->query("SELECT value FROM global_config WHERE name LIKE '%TWITTER_OAUTH_APP_SECRET%'")->fetch_row();
    $twitter_app_redirect_url = $conn->query("SELECT value FROM global_config WHERE name LIKE '%TWITTER_OAUTH_APP_REDIRECT_URL%'")->fetch_row();

    $linkedin_app_id = $conn->query("SELECT value FROM global_config WHERE name LIKE '%LINKEDIN_OAUTH_APP_ID%'")->fetch_row();
    $linkedin_app_secret = $conn->query("SELECT value FROM global_config WHERE name LIKE '%LINKEDIN_OAUTH_APP_SECRET%'")->fetch_row();
    $linkedin_app_redirect_url = $conn->query("SELECT value FROM global_config WHERE name LIKE '%LINKEDIN_OAUTH_APP_REDIRECT_URL%'")->fetch_row();

}



//$linkedin_app_id = \App\Models\GlobalConfig::where(['name' => 'LINKEDIN_OAUTH_APP_ID'])->first('value');
//$linkedin_app_secret = \App\Models\GlobalConfig::where(['name' => 'LINKEDIN_OAUTH_APP_SECRET'])->first('value');
//$linkedin_app_redirect_url = \App\Models\GlobalConfig::where(['name' => 'LINKEDIN_OAUTH_APP_REDIRECT_URL'])->first('value');
return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    // Social auth data

    'google' => [
        'client_id' => ($google_app_id) ? $google_app_id[0] : env('GOOGLE_OAUTH_APP_ID'),
        'client_secret' => ($google_app_secret) ? $google_app_secret[0] : env('GOOGLE_OAUTH_APP_SECRET'),
        'redirect' => ($google_app_redirect_url) ? $google_app_redirect_url[0] : env('GOOGLE_OAUTH_APP_REDIRECT_URL')
    ],
    'facebook' => [
        'client_id' => ($facebook_app_id) ? $facebook_app_id[0] : env('FACEBOOK_CLIENT_ID'),
        'client_secret' => ($facebook_app_secret) ? $facebook_app_secret[0] : env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => ($facebook_app_redirect_url) ? $facebook_app_redirect_url[0] : env('FACEBOOK_CLIENT_CALLBACK')
    ],
    'github' => [
        'client_id' => ($github_app_id) ? $github_app_id[0] : env('GITHUB_OAUTH_APP_ID'),
        'client_secret' => ($github_app_secret) ? $github_app_secret[0] : env('GITHUB_OAUTH_APP_SECRET'),
        'redirect' => ($github_app_redirect_url) ? $github_app_redirect_url[0] : env('GITHUB_OAUTH_APP_REDIRECT_URL')
    ],
    'twitter' => [
        'client_id' => ($twitter_app_id) ? $twitter_app_id[0] : env('TWITTER_OAUTH_APP_ID'),
        'client_secret' => ($twitter_app_secret) ? $twitter_app_secret[0] : env('TWITTER_OAUTH_APP_SECRET'),
        'redirect' => ($twitter_app_redirect_url) ? $twitter_app_redirect_url[0] : env('TWITTER_OAUTH_APP_REDIRECT_URL')
    ],
    'linkedin' => [
        'client_id' => ($linkedin_app_id) ? $linkedin_app_id[0] : env('LINKEDIN_OAUTH_APP_ID'),
        'client_secret' => ($linkedin_app_secret) ? $linkedin_app_secret[0] : env('LINKEDIN_OAUTH_APP_SECRET'),
        'redirect' => ($linkedin_app_redirect_url) ? $linkedin_app_redirect_url[0] : env('LINKEDIN_OAUTH_APP_REDIRECT_URL')
    ],
];
