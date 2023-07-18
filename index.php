<?php
//**************************************************************************************************

//var_dump($_SERVER);
date_default_timezone_set("UTC");

//**************************************************************************************************

// Front Controller
$frontController = [];

if ( $_SERVER["SERVER_ADDR"] == "127.0.0.1" && strtoupper($_SERVER["SystemRoot"]) == "C:\WINDOWS" ) {
   $frontController["server"] = "Local";
}
elseif ( $_SERVER["SERVER_ADDR"] == "192.168.1.1" && $_SERVER["GAE_SERVICE"] == "default" ) {
   $frontController["server"] = "Cloud";
}
else {
   // Неизвестный сервер
   $frontController["server"] = "Unknown";
   var_dump($_SERVER["SERVER_ADDR"]);
   var_dump($_SERVER["SystemRoot"]);
   exit("Unknown server");
}

$frontController["uri"] = explode("?", trim(strtolower($_SERVER['REQUEST_URI']), "/\\"));
$frontController["routeParts"] = explode("/", trim($frontController["uri"][0], "/"));

switch ( $frontController["routeParts"][0] ) {
    case "api" :
        require "api.php";
        break;
    default :
        require "page.php";
        break;
}

//**************************************************************************************************