<?php
session_start();


include("navigation.php");

if (isset($_GET['id']))
{
		$id=$_GET['id'];

	include("connexion_bdd.php");
				

			$requete_eleve="SELECT * FROM eleve WHERE num_groupe = '$id'";
		
			try{
			
				$requete_eleve = $pdo->query($requete_eleve);
				
				$requete_eleve->setFetchMode(PDO::FETCH_OBJ);
				
				
				while ($resultEleve=$requete_eleve->fetch())
				{
				$numEleve=$resultEleve->matricule;
				$requete_delete="DELETE FROM evalue WHERE matricule='$numEleve'";
				$pdo->query($requete_delete);
				}

				



$delete_eleve = "UPDATE eleve SET num_groupe='99' WHERE num_groupe='$id'";
$pdo->query($delete_eleve);

$delete_cours= "DELETE FROM `suit` WHERE `num_groupe`= '$id'";
$pdo->query($delete_cours);

$delete_groupe = "DELETE FROM `groupe` WHERE `num_groupe` = '$id';";
$pdo->query($delete_groupe);
header('groupe.php');


 }
 
 catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					echo $msg;
						}
						
						header("refresh:0;url=groupe.php");
 
}
 
?>