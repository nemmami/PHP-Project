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
        $member = $this->_db->get_member_id($idea->getIdMember());

        # Insertion of a new comments
        $notification = '';
        if(!empty($_POST['form_comments'])) {
            $this->_db->insert_comments($_SESSION['member'], $idea->html_IdIdea(), $_POST['text']);
            $notification = 'Your comments has benn add';
        }

        # Deleting a comment
        $notificationDelete = '';
        if(!empty($_POST['form_delete'])) {
            $comment = $this->_db->get_comments($_POST['form_delete']);
            $comment[0]->markDeleted($_POST['form_delete']);
            $this->_db->update_comments($_POST['form_delete']);
        }

        # All the idea's comments
        $tabComments = $this->_db->get_comments_of_an_idea($_SESSION['idea']);

        include(VIEWS_PATH.'comments.php');
    }

}