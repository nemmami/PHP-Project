<?php
class CommentsController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # If someone writes ?action=comments without going through the login 
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=home"); #  HTTP redirection to the login action
            die();
        }

        $idea = $this->_db->get_idea($_SESSION['idea']);
        $notification = '';
        if(!empty($_POST['form_comments'])) {
            $this->_db->insert_comments($_SESSION['member'], $idea->html_IdIdea(), $_POST['text']);
            $notification = 'Your comments has benn add';
        }

        $notificationDelete = '';
        if(!empty($_POST['form_delete'])) {
            $comment = $this->_db->get_comments($_POST['form_delete']);
            $comment[0]->markDeleted($_POST['form_delete']);
            //var_dump($comment);
            $this->_db->update_comments($_POST['form_delete']);
        }

        $tabComments = $this->_db->get_comments_of_an_idea($_SESSION['idea']);

        include(VIEWS_PATH.'comments.php');
    }

}