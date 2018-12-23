<?php
session_start();

$GLOBALS["config"] = array(
    'mysql'    => array(
        'dbName'   => 'oop',
        'host'     => '127.0.0.1',
        'userName' => 'root',
        'password' => ''
    ),
    'remember' => array(
        'cookieName'   => 'hash',
        'cookieExpire' => '604800'
    ),
    'session'  => array(
        'sessionName' => 'user'
    )

);

spl_autoload_register(
    function ($class){
        require_once "classes/" .$class.".php" ;
    }
);
require_once "functions/sanitization.php";