<?php

class Database extends Base {
    static public $database;
    static protected $table_name = "";
    static protected $columns = [];
    public $errors = [];

    static public function db_connect() {
        $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        self::confirm_db_connect($connection);
        return $connection;
    }

    static public function confirm_db_connect($connection) {
        if($connection->connect_errno) {
            $msg = "Database connection failed: ";
            $msg.= $connection->connect_error;
            $msg.= " (" . $connection->connect_errno . ")";
            exit($msg);
        }
    }

    static public function db_disconnect($connection) {
        if(isset($connection)) {
            unset($connection);
        }
    }

    static public function set_database($database) {
        self::$database = $database;
    }

    

}

?>