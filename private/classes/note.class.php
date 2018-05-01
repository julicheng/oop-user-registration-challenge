<?php

class Note extends Base {
    static protected $table_name = "notes";
    static protected $db_columns = ['id', 'user_id', 'title', 'content'];

    public $id;
    public $user_id;
    public $title;
    public $content;

    public function __construct($args=[]) {
        $this->user_id = $args['user_id'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->content = $args['content'] ?? '';
    }
}

?>