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
<<<<<<< Updated upstream
                $_SESSION['idea'] = $this->_db->insert_idea($_POST['title'], $_POST['text'], $_SESSION['member']);
                //var_dump($_SESSION['idea']);
                $notificationIdea='The idea has been added';
=======
                //$horodatage = date_time_set('D','d','M','','')
                $this->_db->insert_idea($_POST['title'], $_POST['text'], $_SESSION['member']);
                $_SESSION['idea'] = $this->_db->get_idea_exploration($_SESSION['member']);
                //$_SESSION['date'] = $_SESSION['idea']->getSubmittedDate();
                var_dump($_SESSION['idea']);
                $notificationIdea='L\'idée à bien été ajouté';
>>>>>>> Stashed changes
            }

        }
        include (VIEWS_PATH.'profile.php');
    }
}