<?php
class RegisterController {

    private  $_db;

    public function __construct($db) {
        $this->_db = $db;
    }


    public function run() {
        $notificationRegister = "";
        $notificationLogin="";
        if (!empty($_POST['form_ajout'])) {
            if (empty($_POST['username']) && empty($_POST['email']) && empty($_POST['password'])) {
                $notificationRegister = 'Please enter a username, email and password';
            } elseif (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                $notificationRegister = 'please complete all gaps.';
            } elseif ($this->_db->username_exists($_POST['username'])) {
                $notificationRegister = 'The username already exists, choose another.';
            } elseif($this->_db->email_exists($_POST['email'])){
                $notificationRegister = 'This email is already in used.';
            } else {
                $this->_db->insert_membre($_POST['username'], $_POST['email'] ,password_hash($_POST['password'], PASSWORD_BCRYPT));
                $notificationRegister = 'The user has been added';
            }

        }

        # The Accueil controller ends by writing his view
        include(VIEWS_PATH . 'home.php');
    }
}