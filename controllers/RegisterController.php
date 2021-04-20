<?php


class RegisterController
{


    public function __construct()
    {

    }

    public function run()
    {


        $tabMembres = db::getInstance()->selectMembres();


        # Le contrôleur d'acceuil se termine en écrivant la vue accueil
        require_once(VIEWS_PATH . 'home.php');
    }
}