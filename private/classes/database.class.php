<?php

class Database {
    static public $database;
    static protected $table_name = "";
    static protected $columns = [];
    public $errors = [];

    // --- Connecting to database ---
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

    // --- SQL queries ---
    static public function find_by_sql($sql) {
        $result = self::$database->query($sql);
        if(!$result) {
            exit("Database query failed.");
        } 
        // create an array storing objects
        $object_array = [];

        while ($record = $result->fetch_assoc()) {
            $object_array[] = static::instantiate($record);
        }

        $result->free();
        return $object_array;
    }

    static public function find_all() {
        $sql = "SELECT * FROM " . static::$table_name;
        return $result = static::find_by_sql($sql);
    }

    static public function find_by_id($id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql.= "WHERE id='" . static::$database->escape_string($id) . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
            return array_shift($obj_array);
        } else {
            return false;
        }
    }

    static protected function instantiate($record) {
        $object = new static;
        // Could manually assign values
        // but auto asssignment is easier and re-usable
        foreach($record as $property => $value) {
             // if property exists in the static e.g. user or notes
            if(property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }

    protected function validate() {
        $this->errors = [];
        // add custom validations
        return $this->errors;
    }

    protected function create() {
        $this->validate();

        if(!empty($this->errors)) { return false; }
        
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . static::$table_name . " (";
        $sql.= join(', ', array_keys($attributes));
        $sql.= ") VALUES ('";
        $sql.= join("', '", array_values($attributes));
        $sql.= "')";

        $result = self::$database->query($sql);

        if($result) {
            $this->id = self::$database->insert_id;
        }
        return $result;
    }

    public function save() {
        // A new record will not have an ID yet
        if(isset($this->id)) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    protected function update() {
        $this->validate();
        
        if(!empty($this->errors)) { return false; }
        
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = [];
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . static::$table_name . " SET ";
        $sql.= join(', ', $attribute_pairs);
        $sql.= " WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql.= "LIMIT 1";

        $result = self::$database->query($sql);
        return $result;
    }

    public function merge_attributes($args=[]) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Properties which have database columns, excluding id
    public function attributes() {
        $attributes = [];
        foreach(static::$db_columns as $column) {
            if($column == 'id') { continue; }
            $attributes[$column] = $this->$column;
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        $sanitized = [];
        foreach($this->attributes() as $key => $value) {
        $sanitized[$key] = self::$database->escape_string($value);
        }
        return $sanitized;
    }

    public function delete() {
        $sql = "DELETE FROM " . static::$table_name . " ";
        $sql.= "WHERE id='" . self::$database->escape_string($this->id) . "' ";
        $sql.= "LIMIT 1";
        $result = self::$database->query($sql);
        return $result;
    }

}

?>