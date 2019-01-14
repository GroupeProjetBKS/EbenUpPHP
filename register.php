<?php
	include "fonctions.php";
	$db = connexionPDO();
	$results['error']=false;
	$results['message']= [];

	if(isset($_POST)){

		if(!empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2'])  ) {

			$prenom=$_POST['prenom'];
			$adresse=$_POST['adresse'];
			$pseudo=$_POST['pseudo'];
			$email=$_POST['email'];
			$password=$_POST['password'];
			$password2=$_POST['password2'];


			//Verification du pseudo

			if (strlen($pseudo) <2  || !preg_match("/^[a-zA-Z0-9 _-]+$/", $pseudo)  || strlen($pseudo) > 50) {
				$results['error'] = true;
				$results['message']['pseudo'] = "Pseudo invalide";
				print("erreur pseudo");
			}
			else{
				
				$requete=$db->prepare('SELECT pseudo From user where pseudo = :pseudo');
				$requete->execute([':pseudo' => $pseudo]);
				$row = $requete->fetch();
				if($row){
					$results['error'] = true;
					$results['message']['pseudo'] = "Pseudo existe deja";
					print("erreur pseudo deja existant");
				}

			}

			//Verification de l'email

			if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
				$results['error'] = true;
				$results['message']['email'] = "Email invalide";
				print("Email invalide");
			}
			else{
				$requete=$db->prepare('SELECT email From user where email = :email');
				$requete->execute([':email' => $email]);
				$row = $requete->fetch();
				if($row){
					$results['error'] = true;
					$results['message']['pseudo'] = "Email existe deja";
					print("email dejq pris");
				}
			}

			//Verification du mot de passe


			if ($password !== $password2) {
				print("erreur mdp");
				$results['error'] = true;
				$results['message']['password'] = "Il faut que les mot de passe soient identiques";
			}
			
			if ($results['error'] ===false) {
				$password = password_hash($password, PASSWORD_BCRYPT);


				$reket = $db->prepare("INSERT into user Values (NULL, '".$pseudo."', '".$prenom."', '".$adresse."', '".$email."','".$password."')" );
				//$sql->execute([":pseudo => $pseudo" , ":prenom => $prenom", ":adresse => $adresse" , ":email => $email" , ":password => $password"  ]);
				$reket->execute();
				

				if (!$reket) {
					$results['error'] = true;
					$results['message'] = "Erreur";
				}
				print("{ 'passe' : 'oui' }");
			}
			
		}		
	}
	else{
		$results['error'] = true;
		$results['message'] = "Veuillez remplir tous les champs";	
	}
?>
