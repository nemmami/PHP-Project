<?php
class CommentsController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        $idea = $this->_db->get_idea($_SESSION['idea']);
        $notification = '';
        if(!empty($_POST['form_comments'])) {
            $this->_db->insert_comments($_SESSION['member'], $idea->html_IdIdea(), $_POST['text']);
            $notification = 'Your comments has benn add';
        }
        include(VIEWS_PATH.'comments.php');
    }

}