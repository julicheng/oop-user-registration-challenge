<?php

class User extends Database {
    static protected $table_name = "users";
    static protected $db_columns = ['id', 'first_name', 'last_name', 'email', 'hashed_password', 'profile_img'];

    // static protected $db;
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    protected $hashed_password;
    public $password;
    public $confirm_password;
    protected $password_update = true;
    protected $email_update = true;
    protected $profile_update = false;
    protected $file_errors = [];

    public function __construct($args=[]) {
        // $this->db = new Database;
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
        $this->profile_img = $args['profile_img'] ?? '';
    }

    protected function set_hashed_password() {
        $this->hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function verify_password($password) {
        return password_verify($password, $this->hashed_password);
    }

    static public function find_by_email($email) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql.= "WHERE email='" . $email . "'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
    }

    protected function create() {
        $this->set_hashed_password();
        $this->profile_img = "noimage.jpg";
        return parent::create();
    }

    protected function update() {
        if($this->password != "") {
            $this->set_hashed_password();
            // validate password
        } else {
            // password not being updated, skip hashing and validation
            $this->password_update = false;
        }

        $email_user = self::find_by_id($this->id);

        if ($this->email === $email_user->email) {
            $this->email_update = false;
        } else {
            $this->email_update = true;
        }

        if($this->profile_img === "") {
            $this->profile_img = "noimage.jpg";
            $this->profile_update = false;
        } else {
            $this->profile_update = true;
        }

        return parent::update();
    }

    protected function validate() {
        // $this->errors = [];
        $this->errors = $this->file_errors;

        // first name
        if(Validation::is_blank($this->first_name)) {
            $this->errors[] = "First name cannot be blank";
        } elseif(!Validation::has_length($this->first_name, ['min' => 2, 'max' => 255])) {
            $this->errors[] = "First name must be between 2 to 255 characters.";
        }

        // last name
        if(Validation::is_blank($this->last_name)) {
            $this->errors[] = "Last name cannot be blank";
        } elseif(!Validation::has_length($this->last_name, ['min' => 2, 'max' => 255])) {
            $this->errors[] = "Last name must be between 2 to 255 characters.";
        }

        // email
        if(Validation::is_blank($this->email)) {
            $this->errors[] = "Email cannot be blank";
        } elseif(!Validation::has_length($this->email, ['min' => 2, 'max' => 255])) {
            $this->errors[] = "Email must be between 2 to 255 characters.";
        }
        if($this->email_update) {
            if (!Validation::has_unique_email($this->email)) {
                $this->errors[] = "Email already taken.";
            }
        }

        // password
        if($this->password_update) {
            if(Validation::is_blank($this->password)) {
                $this->errors[] = "Password cannot be blank";
            } elseif(!Validation::has_length($this->password, ['min' => 5, 'max' => 255])) {
                $this->errors[] = "Password must be between 5 to 255 characters.";
            }

            // confirm password
            if(Validation::is_blank($this->confirm_password)) {
                $this->errors[] = "Confirm password cannot be blank";
            } elseif($this->password !== $this->confirm_password) {
                $this->errors[] = "Passwords do not match";
            }
        }

        return $this->errors;
    }  
}

?>