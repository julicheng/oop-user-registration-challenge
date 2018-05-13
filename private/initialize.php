<?php
ob_start();

// sessions can only start if you call session_start!
if(!isset($_SESSION)){
    session_start();
}

define("PRIVATE_PATH", dirname(__FILE__)); 
define("PROJECT_PATH", dirname(PRIVATE_PATH)); 
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

define("WWW_ROOT", '/oop-user-registration-challenge/public');

require_once('functions.php');
require_once('db_credentials.php');
require_once('auth_functions.php');
require_once('validation_functions.php');

function my_autoload($class) {
    if(preg_match('/\A\w+\Z/', $class)) {
        include('classes/' . $class . '.class.php');
    }
}

spl_autoload_register('my_autoload');


$database = Database::db_connect();
Database::set_database($database);

// $session = new Session;

?>