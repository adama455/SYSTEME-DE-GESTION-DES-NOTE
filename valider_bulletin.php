<?php

session_start();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Accueil</title>

 <link rel="stylesheet" media="screen" type="text/css" href="css/style.css"/>
 <link href="css/bootstrap.min.css" media="screen" type="text/css" rel="stylesheet">


<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>


<!-- CORPS DE LA PAGE-->

<body >

		<!--HEADER -->
 	
		<header>
		
				<!--NAVIGATION -->
	
			<?php include("navigation.php"); ?>
				
		</header>

					<!--CONTENU DE LA PAGE -->
	
<style> 

table,#bulletin
{
margin-left:50px;
margin-top:50px;
}
td
{
padding:10px;
}
</style>
		<form class="form-horizontal" method="post" action="#">
			
		
<table border="2" cellpadding="15">
			
			<!-- NOM DES COURS-->
			<?php 
			
				
				
				
				if(isset($_SESSION['identifiant']))
				{
				
				echo "<tr>";		
				echo"<td> <b>Matricule</b></td>";							
				echo"<td> <b>Nom</b></td>";												
				echo"<td> <b>Prenom</b></td>";								
				echo"<td> <b>Bulletin non  validé</b></td>";
				echo"<td> <b>Bulletin validé</b></td>";
				echo "</tr>";	
				
					include("connexion_bdd.php");
					$identifiant=$_SESSION['identifiant'];
					$requete=" SELECT matricule, nom_eleve, prenom_eleve, bulletin FROM ELEVE";
					try { 
							$result = $pdo->query($requete);
							$result->setFetchMode(PDO::FETCH_OBJ); 
					
							while ($data = $result->fetch()) {
							$matricule=$data->matricule ;
							$nom_eleve=$data->nom_eleve ;
							$prenom_eleve=$data->prenom_eleve ;
							$bulletin=$data->bulletin ;
						
							
							echo "<tr>";		
							echo"<td> <b>$matricule</b></td>";
							
							echo"<td> <b>$nom_eleve</b></td>";
							
							
							echo"<td> <b>$prenom_eleve</b></td>";
							
							$checked="";
							$checked2="";
							if($bulletin==1)
							{
							$checked="checked";
							}
							else
							{
							$checked2="checked";
							}
						
							
							echo"<td> <b><input type=\"radio\" name=\"$matricule\"  value=\"0\" $checked2></b></td>";
							echo"<td> <b><input type=\"radio\" name=\"$matricule\"  value=\"1\" $checked></b></td>";
				
							
							echo "</tr>";	
					
							}
						}
			
					catch(PDOException $e2) {
					$msg ='ERREUR PDO dans ' . $e2->getFile() . ' Ligne ' . $e2->getLine() . ' : ' . $e2->getMessage(); 
					echo $msg;
					}
			echo "</tr>";			
			
				}
			?>
			
</table >
			<button type="submit" name="valider" style="margin-left:50px; margin-top:20px;" class="btn btn-default">Enregitrer </button>
			</form>
							
							
<?php
			if(isset($_POST["valider"]))
				{
					include("connexion_bdd.php");
				
					$requete=" SELECT matricule FROM ELEVE";
					try { 
							$result = $pdo->query($requete);
							$result->setFetchMode(PDO::FETCH_OBJ); 
					
							while ($data = $result->fetch()) {
							$matricule=$data->matricule ;
							$valeur=$_POST["$matricule"];
								try { 
								$requete2="UPDATE eleve SET bulletin ='$valeur' WHERE matricule='$matricule'";
									$pdo->query($requete2);
											
								}
											
								catch(PDOException $e) {
									$msg ='ERREUR PDO dans ' . $e->getFile() . ' </br> </br>Ligne ' . $e->getLine() . ' :  </br> </br>' . $e->getMessage(); 
									echo $msg;
										
									}
	
							}
						}
			
					catch(PDOException $e2) {
					$msg ='ERREUR PDO dans ' . $e2->getFile() . ' Ligne ' . $e2->getLine() . ' : ' . $e2->getMessage(); 
					echo $msg;
					}
		
				 }
				
				
				

	?>		
					

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>