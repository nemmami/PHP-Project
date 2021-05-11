<?php


class ExplorationadminController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # If someone writes ?action=explorationAdmin without going through the login 
        if (empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=home"); # HTTP redirection to the login action
            die();
        }

        //$idea = $this->_db->get_idea($_SESSION['idea']);

        # Open Idea system management
        $notificationSelect = '';
        if (!empty($_POST['form_open'])) {
            if(empty($_POST['open'])) {
                $notificationSelect = 'Please select an idea to open it';
            } else {
                date_default_timezone_set('Europe/Brussels');
                $datetime = date("Y-m-d H:i:s");
                $this->_db->idea_open_status($_POST['open'], $datetime);
                $notificationSelect = 'The idea\'s status has been updated';
            }
        }

				

        # Close Idea system management
        if (!empty($_POST['form_close'])) {
            if(empty($_POST['close'])) {
                $notificationSelect = 'Please select an idea to close it';
            } else {
                date_default_timezone_set('Europe/Brussels');
                $datetime = date("Y-m-d H:i:s");
                $status = "closed";
                $this->_db->update_status($status, $_POST['close'], $datetime);
                $notificationSelect = 'The idea\'s status has been updated';
            }
        }

        # Refuse Idea system management
        if (!empty($_POST['form_refuse'])) {
            if(empty($_POST['refuse'])) {
                $notificationSelect = 'Please select an idea to refuse it';
            } else {
                date_default_timezone_set('Europe/Brussels');
                $datetime = date("Y-m-d H:i:s");
                $status = "refused";
                //$idea = $this->_db->get_idea($_SESSION['idea']);
                //$id_idea = $idea.getIdIdea();
                $this->_db->update_status($status, $_POST['refuse'], $datetime);
                $notificationSelect = 'The idea\'s status has been updated';
            }
        }


        # Redirection to the comment page
        if(!empty($_POST['form_comments'])) {
            if(empty($_POST['comments'])) {
                $notificationSelect = 'Please select an idea';
            } else {
                $_SESSION['idea'] = $_POST['comments'];
                header("Location: index.php?action=comments");
                die();
            }
        }

        # Limit table management
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

        # Filter table management
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
        else {
            $filter = 'submitted';
            $tabIdeasExploration = $this->_db->get_idea_filter($_SESSION['member'], $filter);
            $notificationFilter = 'The table show submitted ideas';
        }

        include (VIEWS_PATH."explorationAdmin.php");

    }
}