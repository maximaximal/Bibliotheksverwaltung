<?php

require \dirname(__FILE__)."/vendor/autoload.php";

//Add whoops error handling
//Can be commented out!

///**

    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
   
//*/

use App\Config;
    
//Start the session.
session_start();

//Configure variables
Config::set("DB_HOST", "localhost");
Config::set("DB_USER", "test");
Config::set("DB_PASS", "test");
Config::set("DB_NAME", "bibliotheksregister");

//Setup the database.
ORM::configure('mysql:host='.Config::get("DB_HOST").';dbname='.Config::get("DB_NAME"));
ORM::configure('username', Config::get("DB_USER"));
ORM::configure('password', Config::get("DB_PASS"));

?>