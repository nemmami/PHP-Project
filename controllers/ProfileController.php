<?php


class ProfileController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        $notificationIdea = "";
        $tabIdeasProfile = $this->_db->get_idea_profile($_SESSION['member']);
        include (VIEWS_PATH."profile.php");
    }
}