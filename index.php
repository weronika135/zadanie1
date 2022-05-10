<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Twoje IP</title>
    </head>
    <body>
    <?php

function get_user_ip() //pobieranie ip użytkownika
{  
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) 
    {
        $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP)) 
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP)) 
    {
        $ip = $forward;
    }
    else 
    {
        $ip = $remote;
    }

    return $ip;
}

$ip = get_user_ip();    //zapisanie wyniku funkcji do zmiennej

//pobieranie strefy czasowej z ip-api
$info = file_get_contents('http://ip-api.com/json/' . $ip);
$info = json_decode($info);

$timezone = $info->timezone;

//ustawienie strefy czasowej
date_default_timezone_set($timezone);

echo $ip.'<br>';    //zapisanie adresu ip użytkownika
echo date('Y/m/d H:i:s');   //zapisanie daty i godziny w strefie czasowej użytkownika
