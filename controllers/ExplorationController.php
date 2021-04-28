<?php


class ExplorationController{
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        $notificationVote = '';
        $tabIdeasExploration = $this->_db->get_idea_exploration($_SESSION['member']);
        include (VIEWS_PATH."exploration.php");
    }
}