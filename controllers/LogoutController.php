<?php


class LogoutController {
    public function run() {

        $_SESSION = array();

        # Redirection HTTP pour demander la page exploration
        header("Location: index.php?action=home");
        die();
        include(VIEWS_PATH."profile.php");
    }
}