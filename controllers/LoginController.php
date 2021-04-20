<?php


class LoginController {
    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run() {
        /*
        # Si un distrait écrit ?action=login en étant déjà authentifié
        if (!empty($_SESSION['authentifie'])) {
            header("Location: index.php?action=acceuil"); # redirection HTTP vers l'action login
            die();
        }
        */
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
            # Redirection HTTP pour demander la page admin
            //die();
        }

    include(VIEWS_PATH.'home.php');
}

}
?>