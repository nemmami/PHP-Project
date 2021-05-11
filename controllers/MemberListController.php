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
        


        
        if (!empty($_POST['form_remo'])) {
            if(empty($_POST['remove'])) {
                $notificationRole = 'Please select a member';
            } else {
                $this->_db->update_admin_to_member($_POST['remove']);
                $notificationRole = 'Acces has been updated.';
            }
        }

        if (!empty($_POST['form_up'])) {
            if(empty($_POST['upgrade'])) {
                $notificationRole = 'Please select a member';
            } else {
                $this->_db->update_member_to_admin($_POST['upgrade']);
                $notificationRole = 'Acces has been updated.';
            }
        }

        if (!empty($_POST['form_ban'])) {
            if(empty($_POST['upgrade'])) {
                $notificationRole = 'Please select a member';
            } else {
                $this->_db->ban_member($_POST['upgrade']);
                $notificationRole = 'Member banned !';
            }
        }

        if(!empty($_POST['form_role'])) {
            if($_POST['form_role'] == "Admin") {
                $role = 'Admin';
                $tabMembers = $this->_db->get_admin_list();
                $notificationRole = 'The table show Admin members.';
            } elseif($_POST['form_role'] == "Banned") {
                $role = 'Banned';
                $tabMembers = $this->_db->get_banned_list();
                $notificationRole = 'The table show Banned members.';
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

        include (VIEWS_PATH."memberList.php");
    }

}