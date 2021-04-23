<?php

    # Activation of the SESSION mechanism
    session_start();

	define('VIEWS_PATH','views/');
    define('MODELs_PATH','models/');
    define('CONTROLLERS_PATH','controllers/');

	function loadClass($className) {
		require_once('models/' . $className . '.class.php');
	}
	spl_autoload_register('loadClass');

	$db=Db::getInstance();

	include(VIEWS_PATH.'header.php');


    # If there is no variable GET 'action' in the URL, it is created here at the value 'accueil'
    if (empty($_GET['action'])) {
        $_GET['action'] = 'login';
    }

    if (empty($_SESSION['authentifie'])){
        $actionloginadmin='login';
        $libelleloginadmin='Login';
    } else {
        $actionloginadmin='admin';
        $libelleloginadmin='Zone Admin';
    }



    # Switch case on the action requested by the GET 'action' variable specified in the URL
    # index.php?action=...

    switch ($_GET['action']) {
        case 'home' : # action=home
            require_once(CONTROLLERS_PATH.'HomeController.php');
            $controller = new HomeController($db);
            break;
        case 'login': # action=login
            require_once(CONTROLLERS_PATH.'LoginController.php');
            $controller = new LoginController($db);
            break;
        case 'register' :# action=register
            require_once(CONTROLLERS_PATH.'RegisterController.php');
            $controller = new RegisterController($db);
            break;
        case 'logout' : # action=logout
            require_once(CONTROLLERS_PATH.'LogoutController.php');
            $controller = new LogoutController();
            break;
        case 'addIdea' : # action=addIdea
            require_once(CONTROLLERS_PATH.'IdeaController.php');
            $controller = new IdeaController($db);
            break;
        case 'exploration' : # action=exploration
            require_once(CONTROLLERS_PATH.'ExplorationController.php');
            $controller = new ExplorationController($db);
            break;
        default:        # dans tous les autres cas l'action=accueil
            require_once(CONTROLLERS_PATH . 'ProfileController.php');
            $controller = new ProfileController($db);
            break;
    }

    # Execution of the controller defined in the previous switch
    $controller->run();

	include(VIEWS_PATH.'footer.php');
?>