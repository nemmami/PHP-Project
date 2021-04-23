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
                $notificationIdea='Veuillez entrer un titre et un texte';
            } elseif (empty($_POST['title'])) {
                $notificationIdea='Veuillez entrer un titre';
            } elseif (empty($_POST['text'])) {
                $notificationIdea='Veuillez entrer un text';
            } else {
                $_SESSION['idea'] = $this->_db->insert_idea($_POST['title'], $_POST['text'], $_SESSION['member']);
                //var_dump($_SESSION['idea']);
                $notificationIdea='L\'idée à bien été ajouté';
            }

        }
        include (VIEWS_PATH.'profile.php');
    }
}