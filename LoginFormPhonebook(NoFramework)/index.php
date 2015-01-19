<?php

require_once __DIR__.'/DB/Connection.php';
require_once __DIR__.'/Model/User.php';
require_once __DIR__.'/Controller/Controller.php';

$db = new Connection('root', '', '127.0.0.1', 3306, 'login_form');
User::setDB($db);
$controller = new Controller();

$action = array_key_exists('action', $_GET) ? $_GET['action'] : 'login' ;

if (!method_exists($controller, $action)) {
    echo "Incorrect action";
    exit();
}

call_user_func(array($controller, $action));


