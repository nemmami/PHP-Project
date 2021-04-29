<?php


class LoginController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        # If someone writes "?action=login" while being already authenticated 
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=default"); # HTTP redirection to login action
            die();
        }

        $notificationLogin = "";
        $notificationRegister ="";
        # Did the user authenticate correctly?
        if(empty($_POST)) {
            # The user need to complete the form
            $notificationLogin = '';
        } elseif (!$this->_db->valider_utilisateur($_POST['email'], $_POST['password'])) {
            # wrong authentification
            $notificationLogin = 'Your authentication data are wrong.';
        } else {
            # The user is well authenticated
            # session variable $_SESSION['authenticated'] created
            $notificationLogin = 'You are connected.';
            $_SESSION['authentifie'] = 'ok';
            $_SESSION['login'] = $_POST['email'];
            $member = $this->_db->get_member($_POST['email']);
            $_SESSION['member'] = $member->html_IdMember();
            //var_dump($member);
            # HTTP redirection to request the exploration page
            header("Location: index.php?action=default");
            die();
        }

    include(VIEWS_PATH.'home.php');
    }

}
?>