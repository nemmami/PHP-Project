<?php


class ExplorationadminController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # If someone writes ?action=explorationadmin without going through the login 
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=home"); # HTTP redirection to the login action
            die();
        }

        $notificationVote = '';
        if (!empty($_POST['form_vote'])) {
            if(empty($_POST['vote'])) {
                $notificationVote = 'Please select an idea';
            } elseif ($this->_db->possible_vote($_SESSION['member'], $_POST['vote']) == 1) {
                $notificationVote = 'You have already voted for this idea';
            } else {
                $this->_db->insert_vote($_SESSION['member'], $_POST['vote']);
                $nbr = $this->_db->get_number_of_vote($_POST['vote']);
                $idea = $this->_db->get_idea($_POST['vote']);
                //var_dump($idea);
                $idea->setNumberOfVotes($nbr);
                $this->_db->update_idea($_POST['vote'],$nbr);
                //var_dump($idea);
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

        if(!empty($_POST['form_tab'])) {
            if($_POST['form_tab'] == 'top_3') {
                $tabIdeasExploration = $this->_db->get_idea_exploration_limit_3($_SESSION['member']);
            } elseif ($_POST['form_tab'] == 'top_10') {
                $tabIdeasExploration = $this->_db->get_idea_exploration_limit_10($_SESSION['member']);
            } else {
                $tabIdeasExploration = $this->_db->get_idea_exploration($_SESSION['member']);
            }
        }
        else {
            $tabIdeasExploration = $this->_db->get_idea_exploration($_SESSION['member']);
        }

        $filter = 'submitted';
        $notificationFilter = 'The table show submitted ideas';
        if(!empty($_POST['form_filter'])) {
            if($_POST['form_filter'] == 'submitted') {
                $filter = 'submitted';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
            } elseif ($_POST['form_filter'] == 'closed') {
                $filter = 'closed';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
                $notificationFilter = 'The table show closed ideas';
            } elseif ($_POST['form_filter'] == 'openned') {
                $filter = 'openned';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
                $notificationFilter = 'The table show openned ideas';
            } else {
                $filter = 'refused';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
                $notificationFilter = 'The table show refused ideas';
            }
        }
        else {
            $filter = 'submitted';
            $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
            $notificationFilter = 'The table show submitted ideas';
        }

        include (VIEWS_PATH."explorationAdmin.php");

    }
}