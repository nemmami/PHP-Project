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
                $notificationRegister = 'Veuillez entrer un pseudo, un email et un mot de passe';
            } elseif (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
                $notificationRegister = 'Veuillez remplir tout les champs';
            } elseif ($this->_db->username_exists($_POST['username'])) {
                $notificationRegister = 'Le pseudo existe déjà, choisissez un autre pseudo';
            } elseif($this->_db->email_exists($_POST['email'])){
                $notificationRegister = 'Cette email est déja utilisé, choisissez en un autre';
            } else {
                $this->_db->insert_membre($_POST['username'], $_POST['email'] ,password_hash($_POST['password'], PASSWORD_BCRYPT));
                $notificationRegister = 'L\'utilisateur a bien été ajouté';
            }

        }

        # Le contrôleur d'acceuil se termine en écrivant la vue accueil
        include(VIEWS_PATH . 'home.php');
    }
}