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

        # Voting system management
        $notificationVote = '';
        if (!empty($_POST['form_vote'])) {
            if(empty($_POST['vote'])) {
                $notificationVote = 'Please select an idea';
            } elseif ($this->_db->possible_vote($_SESSION['member'], $_POST['vote']) == 1) {
                # The user has already voted for this idea
                $notificationVote = 'You have already voted for this idea';
            } else {
                $this->_db->insert_vote($_SESSION['member'], $_POST['vote']);
                $nbr = $this->_db->get_number_of_vote($_POST['vote']);
                $idea = $this->_db->get_idea($_POST['vote']);
                $idea->setNumberOfVotes($nbr);
                $this->_db->update_idea($_POST['vote'],$nbr);
                $notificationVote = 'Your vote has been added';
            }
        }

        # Redirection to the comment page
        if(!empty($_POST['form_comments'])) {
            if(empty($_POST['comments'])) {
                $notificationVote = 'Please select an idea';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                header("Location: index.php?action=comments");
                die();
            }
        }

        # Limit table management
        $top = 0;
        if(!empty($_POST['form_tab'])) {
            if($_POST['form_tab'] == 'top_3') {
                $tabIdeasExploration = $this->_db->get_idea_exploration_limit_3($_SESSION['member']);
                $top = 3;
            } elseif ($_POST['form_tab'] == 'top_10') {
                $tabIdeasExploration = $this->_db->get_idea_exploration_limit_10($_SESSION['member']);
                $top = 10;
            } else {
                $tabIdeasExploration = $this->_db->get_idea_exploration($_SESSION['member']);
                $top = 'all';
            }
        }
        else {
            $tabIdeasExploration = $this->_db->get_idea_exploration($_SESSION['member']);
        }

        # Filter table management
        $filter = 'all';
        $notificationFilter = 'The table show submitted ideas';
        if(!empty($_POST['form_filter'])) {
            if($_POST['form_filter'] == 'submitted') {
                $filter = 'submitted';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
            } elseif ($_POST['form_filter'] == 'closed') {
                $filter = 'closed';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
                $notificationFilter = 'The table show closed ideas';
            } elseif ($_POST['form_filter'] == 'opened') {
                $filter = 'opened';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
                $notificationFilter = 'The table show openned ideas';
            } else {
                $filter = 'refused';
                $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
                $notificationFilter = 'The table show refused ideas';
            }
        }


        include (VIEWS_PATH."exploration.php");

    }
}