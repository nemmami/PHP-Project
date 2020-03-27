<?php 
class LivresController{

	public function __construct() {
	
	}
			
	public function run(){	
	
		require_once('models/Db.php');
		
		# Notification qui sera affichée dans la vue
		$notification='';
		
		# Tableau de Livre qui sera parcouru dans la vue 
		$tablivres='';
		
		# Mot clé de recherche
		$motcle='';
		
		# Insertion des données d'un livre en provenance du formulaire form_ajout
		if (!empty($_POST['form_ajout'])) {
			if (empty($_POST['titre']) && empty($_POST['auteur'])) {
				$notification='Veuillez entrer un titre et un auteur';
			} elseif (empty($_POST['titre'])) {
				$notification='Veuillez entrer un titre';
			} elseif (empty($_POST['auteur'])) {
				$notification='Veuillez entrer un auteur';
			} else {	
				Db::getInstance()->insert_livre(htmlspecialchars($_POST['titre']),htmlspecialchars($_POST['auteur']));
				$notification='Ajout bien fait';
			}
		}
		
		# Recherche si un mot clé est entré dans le formulaire form_recherche
		if (!empty($_POST['form_recherche']) 
		    && !empty($_POST['keyword'])) {
			$tablivres=Db::getInstance()->select_livres(htmlspecialchars($_POST['keyword']));
			$motcle=htmlspecialchars($_POST['keyword']);
		} else {
			# Sélection de tous les livres sous forme de tableau
			$tablivres=Db::getInstance()->select_livres();
		}
		
		# Ecrire ici la vue
		# $tablivres contient un tableau d'objets de la classe Livre
		# $notification contient un message destiné à l'utilisateur
		require_once(CHEMIN_VUES . 'livres.php');
	}
} 
?>