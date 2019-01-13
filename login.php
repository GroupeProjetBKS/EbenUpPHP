<?php
	include "fonctions.php";
	$db = connexionPDO();
	$results['error']=false;
	$results['message']= [];


	if(!empty($_POST)){

		if (!empty($_POST['pseudo']) && !empty($_POST['password'])  ) {
			
			$pseudo=$_POST['pseudo'];
			$password=$_POST['password'];


			$requete=$db->prepare('SELECT * From user where pseudo = :pseudo');
			$requete->execute([':pseudo' => $pseudo]);
			$row = $requete->fetch(PDO::FETCH_OBJ);
			if ($row) {
				if (password_verify($password,$row->password)) {
					$results['error'] = true;
					//print_r($row);
					$results['id'] = $row->user_id;
					$results['pseudo'] = $row->pseudo;
				}
				else{
					$results['error'] = true;
					$results['message'] = "Pseudo ou mot de passe incorrect";
				}
				
			}
			else {
				$results['error'] = true;
				$results['message'] = "Pseudo ou mot de passe incorrect";
			}


		}

		else{
			
			$results['error'] = true;
			$results['message'] = "Il faut remplir tous les champs";

		}

	}
?>	

