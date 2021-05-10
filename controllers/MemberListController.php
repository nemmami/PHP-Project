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
        
        
        $notificationRole = '';
        if(!empty($_POST['form_role'])) {
            if($_POST['form_role'] == "Admin") {
                $role = 'Admin';
                $tabMembers = $this->_db->get_admin_list();
                $notificationRole = 'The table show Admin members.';
            } else {
                $role = 'Member';
                $tabMembers = $this->_db->get_simple_members_list();
                $notificationRole = 'The table show non-admin Members.';
            }
        }
        else {
            $role = 'Member';
            $tabMembers = $this->_db->get_simple_members_list();
            $notificationRole = 'The table show non-admin Members.';
        }


        if (!empty($_POST['form_remo'])) {
            if(empty($_POST['remove'])) {
                $notificationVote = 'Please select a member';
            } else {
                $this->_db->update_admin_to_member($_SESSION['member']);
                $notificationVote = 'Acces has been updated.';
            }
        }

        if (!empty($_POST['form_up'])) {
            if(empty($_POST['upgrade'])) {
                $notificationVote = 'Please select a member';
            } else {
                $this->_db->update_member_to_admin($_SESSION['member']);
                $notificationVote = 'Acces has been updated.';
            }
        }


        include (VIEWS_PATH."memberList.php");
    }

}