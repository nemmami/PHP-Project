<?php
class CommentsController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # Si un petit fûté écrit ?action=comments sans passer par l'action login
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=home"); # redirection HTTP vers l'action login
            die();
        }

        $idea = $this->_db->get_idea($_SESSION['idea']);
        $notification = '';
        if(!empty($_POST['form_comments'])) {
            $this->_db->insert_comments($_SESSION['member'], $idea->html_IdIdea(), $_POST['text']);
            $notification = 'Your comments has benn add';
        }

        if(!empty($_POST['delete'])) {
            $comment = $this->_db->get_comments($_POST['delete']);
            $comment[0]->__set($_POST['delete'],0);
            var_dump($comment);
            $notification = 'Your comments has been deleted';
        }

        $tabComments = $this->_db->get_comments_of_an_idea($_SESSION['idea']);

        include(VIEWS_PATH.'comments.php');
    }

}