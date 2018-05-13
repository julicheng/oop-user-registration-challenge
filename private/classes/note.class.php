<?php

class Note extends Database {
    static protected $table_name = "notes";
    static protected $db_columns = ['id', 'user_id', 'title', 'content'];

    // protected $db; // for use when instantiating Database object
    public $id;
    public $user_id;
    public $title;
    public $content;

    public function __construct($args=[]) {
        // $this->db = new Database; // so can use Database class non-static methods
        $this->user_id = $args['user_id'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->content = $args['content'] ?? '';
    }

    static public function find_all_by_id($user_id) {
        $sql = "SELECT * FROM " . static::$table_name . " ";
        $sql.= "WHERE user_id='" . $user_id . "'";
        $result = static::find_by_sql($sql);
        return $result;
    }

    protected function validate() {
        $this->errors = [];

        // title
        if(Validation::is_blank($this->title)) {
            $this->errors[] = "Title cannot be blank";
        } elseif(!Validation::has_length($this->title, ['min' => 2, 'max' => 255])) {
            $this->errors[] = "Title must be between 2 to 255 characters.";
        }

        // content
        if(Validation::is_blank($this->content)) {
            $this->errors[] = "Content cannot be blank";
        } elseif(!Validation::has_length($this->content, ['min' => 15])) {
            $this->errors[] = "Content must be at least 15 characters.";
        }
        
        return $this->errors;
    }
}

?>