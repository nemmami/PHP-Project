<?php
class MemberListController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run(){

        # If someone writes ?action=memberList without going through the login 
        if (empty($_SESSION['authentifie']) || $_SESSION['IsAdmin'] == 0) {
            header("Location: index.php?action=home"); # HTTP redirection to the login action
            die();
        }
        
        $tabMembers = $this->_db->get_members_list();

        include (VIEWS_PATH."memberList.php");
    }

}