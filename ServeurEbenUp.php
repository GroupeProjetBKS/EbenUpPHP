<?php 
	include "fonctions.php";
	
	if(isset($_REQUEST["operation"])){
		/*if($_REQUEST["operation"]=="chercherPost"){
			try{
				$donnees = $_REQUEST["data"];
				$data = json_decode($donnees);
				$id = $data[0];
				if(count($data) != 1){
					break;
				}
				$cnx = connexionPDO();
				$req = $cnx->prepare("SELECT * FROM post WHERE ID = :id")
				$req->bindParam(':id', $id);
				$req->execute();
				if($post = $req->fetch(PDO::FETCH_ASSOC)){
					
				}
			}catch(PDOException $e{
				print("erreur : $e");
				die();
			}
			
		}
		else */if($_REQUEST["operation"]=="publierPost"){
			try{
				$donnees = $_REQUEST["data"];
				$cnx = connexionPDO();
				$data = json_decode($donnees);
				$userId = 26;
				$title = $data[1];
				$desc = $data[2];
				$coif = $data[3];
				$yeux = $data[4];
				$sourcil = $data[5];
				$levre = $data[6];
				$teint = $data[7];
				$chemin = $data[8];
				$type = $data[9];
				$extension = $data[10];
				$dateajd = date("Y-m-d");
				$req = $cnx->prepare("insert into post values ( null, '".$userId."', '".$dateajd."', '".$title."', '".$desc."', 0, 0, 0, 0, 0, '".$coif."', '".$yeux."', '".$sourcil."', '".$levre."', '".$teint."', '".$chemin."', '".$type."', '".$extension."')");
				$req->execute();
				print("insert into post values ( null , $userId, $dateajd, $title, $desc, 0, 0, 0, 0, 0, $coif, $yeux, $sourcil, $levre, $teint, $chemin, $type, $extension)");
				
			}catch(PDOException $e){
				print("issou c plat");
				die();
			}
		}
		/*else if($_REQUEST["operation"]=="chercherUtilisateur"){
			try{
				
			}catch(PDOException $e{
				print("erreur : $e");
				die();
			}
		}*/
	}
?>