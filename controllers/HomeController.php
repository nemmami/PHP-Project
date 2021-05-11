<?php
class HomeController {

    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run(){
        # If someone writes "?action=home" while being already authenticated
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=default");
            die();
        }

        $notificationLogin = "";
        # Did the user authenticate correctly?
        if(empty($_POST['form_login'])) {
            # The user need to complete the form
            $notificationLogin = '';
        } elseif (!$this->_db->valide_user($_POST['email'], $_POST['password'])) {
            # wrong authentification
            $notificationLogin = 'Your authentication data are wrong.';
        } elseif ($this->_db->get_member($_POST['email'])->html_IsBanned() == 1) {
            # Banned member authentification
            $notificationLogin = 'Your authentication data are from a Banned account.';
        } else {
            # The user is well authenticated
            # session variable $_SESSION['authenticated'] created
            $notificationLogin = 'You are connected.';
            $_SESSION['authentifie'] = 'ok';
            $_SESSION['login'] = $_POST['email'];
            $member = $this->_db->get_member($_POST['email']);
            $_SESSION['member'] = $member->html_IdMember();
            $_SESSION['IsAdmin'] = $member->html_IsAdmin();
            # HTTP redirection to request the exploration page
            header("Location: index.php?action=default");
            die();
        }

        $notificationRegister = "";
        if (!empty($_POST['form_register'])) {
            # The user need to complete the form
            if (empty($_POST['username']) && empty($_POST['email']) && empty($_POST['password'])) {
                $notificationRegister = 'Please enter a username, email and password';
            } elseif (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                $notificationRegister = 'Please complete all gaps.';
            } elseif ($this->_db->username_exists($_POST['username'])) {
                # The username already exist
                $notificationRegister = 'The username already exists, choose another.';
            } elseif($this->_db->email_exists($_POST['email'])){
                # The username already exist
                $notificationRegister = 'This email is already in used.';
            } else {
                # The user has successfully registered
                $this->_db->insert_membre($_POST['username'], $_POST['email'] ,password_hash($_POST['password'], PASSWORD_BCRYPT));
                $notificationRegister = 'The user has been added';
            }

        }
        include(VIEWS_PATH.'home.php');
    }

}
?>