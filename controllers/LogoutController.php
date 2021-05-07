<?php


class LogoutController {
    public function run() {
        $_SESSION = array();
        # HTTP redirection to request the exploration page
        header("Location: index.php?action=home");
        die();
        include(VIEWS_PATH."profile.php");
    }
}