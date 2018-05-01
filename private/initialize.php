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

define("WWW_ROOT", '/user-registration-challenge/public');

require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once('auth_functions.php');
require_once('validation_functions.php');

$db = db_connect(); 

?>