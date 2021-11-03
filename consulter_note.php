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

<h4 style="margin:50px"> Identifiant : <?php if(isset($_SESSION['identifiant'])){echo $_SESSION['identifiant']; }?></h4>	
					
<table border="2" cellpadding="15">
			
			<!-- NOM DES COURS-->
			<?php 
				if(isset($_SESSION['identifiant']))
				{
				
				echo "<tr>";		
					include("connexion_bdd.php");
					$identifiant=$_SESSION['identifiant'];
					$requete=" SELECT NOM_COURS,note_DE,note_PRJ,note_CE,note_TP FROM COURS A, EVALUE C WHERE A.id_cours=C.id_cours AND C.matricule=$identifiant ";
					try { 
							$result = $pdo->query($requete);
							$result->setFetchMode(PDO::FETCH_OBJ); 
					
							while ($data = $result->fetch()) {
							$nom_cours=$data->NOM_COURS ;
							$note_DE=$data->note_DE ;
							$note_PRJ=$data->note_PRJ ;
							$note_CE=$data->note_CE ;
							$note_TP=$data->note_TP ;
							
							echo "<tr>";		
							echo"<td> <b>$nom_cours</b></td>";
							
							echo"<td> <b>DE : $note_DE</b></td>";
							
							
							echo"<td> <b>PROJET : $note_PRJ</b></td>";
							
							
							echo"<td> <b>CE : $note_CE</b></td>";
							
							
							echo"<td> <b>TP : $note_TP</b></td>";	
							
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

<?php
	if(isset($_SESSION['identifiant']))
				{
				
				echo "<tr>";		
					include("connexion_bdd.php");
					$identifiant=$_SESSION['identifiant'];
					$requete=" SELECT BULLETIN FROM ELEVE WHERE matricule=$identifiant ";
					try { 
							$result = $pdo->query($requete);
							$result->setFetchMode(PDO::FETCH_OBJ); 
					
							while ($data = $result->fetch()) {
							$bulletin=$data->BULLETIN ;
							}
					
					}
					
					catch(PDOException $e2) {
					$msg ='ERREUR PDO dans ' . $e2->getFile() . ' Ligne ' . $e2->getLine() . ' : ' . $e2->getMessage(); 
					echo $msg;
					}
					
					if($bulletin==1)
					{
					?>
					<!-- <div id="bulletin">		
						<div class="form-group">

						<label > <a target="_blank" href="generer_pdf.php">Imprimer mon bulletin </a> </label>
										
						</div>	
					</div> -->

					<?php

						}
					
					}

					?>
					
					

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>