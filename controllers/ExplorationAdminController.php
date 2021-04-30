<?php


class ExplorationController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # If someone writes ?action=exploration without going through the login 
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=home"); # HTTP redirection to the login action
            die();
        }

        $notificationVote = '';
        $tabIdeasExploration = $this->_db->get_idea_exploration($_SESSION['member']);
        if (!empty($_POST['form_vote'])) {
            if(empty($_POST['vote'])) {
                $notificationVote = 'Please select an idea';
            } elseif ($this->_db->possible_vote($_SESSION['member'], $_POST['vote']) == 1) {
                $notificationVote = 'You have already voted for this idea';
            } else {
                $this->_db->insert_vote($_SESSION['member'], $_POST['vote']);
                $notificationVote = 'Your vote has been added';

            }
        }

        if(!empty($_POST['form_comments'])) {
            if(empty($_POST['comments'])) {
                $notificationVote = 'Please select an idea';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                //var_dump($_SESSION['idea']);
                header("Location: index.php?action=comments");
                die();
            }
        }
        include (VIEWS_PATH."explorationAdmin.php");

    }
}