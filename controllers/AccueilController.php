<?php 
class AccueilController {
		
	public function __construct(){	

	}
	
	public function run(){	
		# Message à afficher dans la vue, balises HTML interdites ici !
		$message = "Bonjour tout le monde !";

		# Obtention de la date du jour à l'aide d'une fonction PHP
		$date = date('j/m/Y');

		# Ecriture de la vue : accueil.php 
		# Variables présentes dans la vue : $message, $date
		require_once(CHEMIN_VUES.'accueil.php');
	}
	
}
?>