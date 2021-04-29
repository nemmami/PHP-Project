<?php
class VoteController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {

        $notificationVote = '';
        $tabIdeasExploration = $this->_db->get_idea_exploration($_SESSION['member']);
        //var_dump($_POST);
        if (!empty($_POST['form_vote'])) {
            if(empty($_POST['vote'])) {
                $notificationVote = 'Veuillez selectionner une idée';
            } elseif ($this->_db->possible_vote($_SESSION['member'], $_POST['vote']) == 1) {
                $notificationVote = 'Vous avez déjà voté pour cette idée';
            } else {
                $this->_db->insert_vote($_SESSION['member'], $_POST['vote']);
                $notificationVote = 'Votre vote a bien été ajouté';

            }
        }

        if(!empty($_POST['form_comments'])) {
            if(empty($_POST['comments'])) {
                $notificationVote = 'Veuillez selectionner une idée';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                //var_dump($_SESSION['idea']);
                header("Location: index.php?action=comments");
                die();
            }
        }
        include(VIEWS_PATH . 'exploration.php');
    }

}