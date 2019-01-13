<?php 
	function connexionPDO(){
		$login = "root";
		$mdp = "";
		$bd = "EbenUpDB";
		$serveur = "localhost";
		try{
			$connexion = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp);
			return $connexion;
		} catch(PDOException $e){
			print("Erreur de connexion PDO $e");
			die();
		}
		function e($text){
			return htmlspecialchars($text, ENT_QUOTES);
		}
	}
?>