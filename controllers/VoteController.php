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
            if ($this->_db->possible_vote($_SESSION['member'], $_POST['vote']) == 0) {
                $notificationVote = 'Vous avez déjà voté pour cette idée';
            } else {
                $this->_db->insert_vote($_SESSION['member'], $_POST['vote']);
                $notificationVote = 'Votre vote a bien été ajouté';
            }
        }
        include(VIEWS_PATH . 'exploration.php');
    }

}