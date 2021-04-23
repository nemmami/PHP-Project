<?php


class LoginController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {

        # Si un distrait écrit ?action=login en étant déjà authentifié
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=default"); # redirection HTTP vers l'action login
            die();
        }

        $notificationLogin = "";
        $notificationRegister ="";

        # L'utilisateur s'est-il bien authentifié ?

        if(empty($_POST)) {
            # L'utilisateur doit remplir le formulaire
            $notificationLogin = '';
        } elseif (!$this->_db->valider_utilisateur($_POST['email'], $_POST['password'])) {
            # L'authentification n'est pas correcte
            $notificationLogin = 'Vos données d\'authentification ne sont pas correctes.';
        } else {
            # L'utilisateur est bien authentifié
            # Une variable de session $_SESSION['authenticated'] est créée
            $notificationLogin = 'Vous etes connecté';
            $_SESSION['authentifie'] = 'ok';
            $_SESSION['login'] = $_POST['email'];
            $member = $this->_db->get_member($_POST['email']);
            $_SESSION['member'] = $member->html_IdMember();
            //var_dump($member);
            # Redirection HTTP pour demander la page exploration
            header("Location: index.php?action=default");
            die();
        }

    include(VIEWS_PATH.'home.php');
    }

}
?>