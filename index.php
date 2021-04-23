<?php

    # Activation du mécanisme des SESSIONs
    session_start();

	define('VIEWS_PATH','views/');
    define('CONTROLLERS_PATH','controllers/');

	function loadClass($className) {
		require_once('models/' . $className . '.class.php');
	}
	spl_autoload_register('loadClass');

	$db=Db::getInstance();

	include(VIEWS_PATH.'header.php');


    # S'il n'y a pas de variable GET 'action' dans l'URL, elle est créée ici à la valeur 'accueil'
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



# Switch case sur l'action demandée par la variable GET 'action' précisée dans l'URL
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
        case 'logout' : # action=home
            require_once(CONTROLLERS_PATH.'LogoutController.php');
            $controller = new LogoutController();
            break;
        case 'addIdea' : # action=home
            require_once(CONTROLLERS_PATH.'IdeaController.php');
            $controller = new IdeaController($db);
            break;
        default:        # dans tous les autres cas l'action=accueil
            require_once(CONTROLLERS_PATH.'AcceuilController.php');
            $controller = new AcceuilController();
            break;
    }

    # Exécution du contrôleur défini dans le switch précédent
    $controller->run();

	include(VIEWS_PATH.'footer.php');
?>