<?php

class User extends Base {
    static protected $table_name = "users";
    static protected $db_columns = ['id', 'first_name', 'last_name', 'email', 'hashed_password', 'profile_img'];

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    protected $hashed_password;
    public $password;
    public $confirm_password;
    protected $password_required = true;

    public function __construct($args=[]) {
        $this->first_name = $args['first_name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->confirm_password = $args['confirm_password'] ?? '';
        $this->profile_img = $args['profile_img'] ?? '';
    }
}

?>