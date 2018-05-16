<?php
require_once('../private/initialize.php');

$session->log_out();

redirect_to(url_for('login.php'));

?>
