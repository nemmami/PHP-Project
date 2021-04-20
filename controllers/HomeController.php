<?php
class HomeController {

    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function run(){
        $notificationLogin = "";
        $notificationRegister = "";
        include(VIEWS_PATH.'home.php');
    }

}
?>