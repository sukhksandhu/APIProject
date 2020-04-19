<?php
//Reference from https://www.youtube.com/watch?v=g0l28ta4XjA for facebook aPI login during college project
session_start();
require './vendor/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' =>'914377302316570',
    'app_secret'=>'267364a966ecc3d1c12587599ec5f803',
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
