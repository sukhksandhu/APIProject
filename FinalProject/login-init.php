<?php
//Reference from https://www.youtube.com/watch?v=g0l28ta4XjA for facebook aPI login during college project
session_start();
require './vendor/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' =>'',
    'app_secret'=>'',
    'default_graph_version' =>'v2.7'
]);
$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("http://localhost/FinalProject/");
//echo $login_url;
    try
    {
        $access = $helper->getAccessToken();
        if(isset($access))
        {
            $_SESSION['access_token'] = (string)$access;
            header('Location:index.php');
        }
    }
    catch(Exception $e)
    {
        echo $e->getTraceAsString();
    }
