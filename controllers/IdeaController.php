<?php


class IdeaController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        $notificationIdea = '';
        if (!empty($_POST['form_ajout'])) {
            if (empty($_POST['title']) && empty($_POST['text'])) {
                $notificationIdea='Please enter a title and the text';
            } elseif (empty($_POST['title'])) {
                $notificationIdea='Please enter a title';
            } elseif (empty($_POST['text'])) {
                $notificationIdea='Please enter a text';
            } else {
                $_SESSION['idea'] = $this->_db->insert_idea($_POST['title'], $_POST['text'], $_SESSION['member']);
            }

        }
        $tabIdeasProfile = $this->_db->get_idea_profile($_SESSION['member']);;
        include (VIEWS_PATH.'profile.php');

    }


}