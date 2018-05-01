<?php 

function log_in($user) {
    // Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['id'] = $user['id'];
    $_SESSION['first_name'] = $user['first_name'];
    $_SESSION['last_name'] = $user['last_name'];
    $_SESSION['email'] = $user['email'];
    return true;
}

function log_out() {
    unset($_SESSION['id']);
    unset($_SESSION['first_name']);
    unset($_SESSION['last_name']);
    unset($_SESSION['email']);
    return true;
}

 function is_logged_in() {
    return isset($_SESSION['first_name']); // if true then don't redirect
  }

  function require_login() {
    if(!is_logged_in()) {
      redirect_to(url_for('/login.php'));
    } else {
      // goes to index.php
    }
  }  

?>