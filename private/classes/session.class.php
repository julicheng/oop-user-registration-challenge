<?php

class Session {
    public $id;
    public $first_name;
    public $last_name;
    public $email;

    public function __construct() {
        session_start();
        
        $this->check_stored_login();
    }

    public function log_in($user) {
        // prevent session fixation attacks
        session_regenerate_id();
        if($user) {
            $this->id = $_SESSION['id'] = $user->id;
            $this->first_name = $_SESSION['first_name'] = $user->first_name;
            $this->last_name = $_SESSION['last_name'] = $user->last_name;
            $this->email = $_SESSION['email'] = $user->email;
        }
        return true;
    }

    public function is_logged_in() {
        return isset($this->id);
    }

    public function log_out() {
        unset($_SESSION['id']);
        unset($_SESSION['first_name']);
        unset($_SESSION['last']);
        unset($_SESSION['email']);

        unset($this->id);
        unset($this->first_name);
        unset($this->last_name);
        unset($this->email);
    }

    private function check_stored_login() {
        if(isset($_SESSION['id'])) {
            $this->id = $_SESSION['id'];
            $this->first_name = $_SESSION['first_name'];
            $this->last_name = $_SESSION['last_name'];
            $this->email = $_SESSION['email'];
        }
    }

    public function message($msg="") {
        if(!empty($msg)) {
            // this is a set message
            $_SESSION['message'] = $msg;
            return true;
        } else {
            // this is a get message
            return $_SESSION['message'] ?? "";
        }
    }

    // public function clear_message() {
    //     unset($_SESSION['message']);
    // }

    private function get_and_clear_session_message() {
    if(isset($_SESSION['message']) && $_SESSION['message'] != "") {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        return $msg;
        }
    }

    public function display_session_message() {
        $msg = $this->get_and_clear_session_message();
        if(!Validation::is_blank($msg)) {
            return '<div id="message">' . $msg . '</div>';
        }
    }

    public function require_login() {
        if(!isset($this->id)) {
        redirect_to(url_for('/login.php'));
        } else {
        // goes to index.php
        }
    }
}

?>