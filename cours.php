<?php

session_start();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Gestion des cours</title>


 <link href="css/bootstrap.min.css" media="screen" type="text/css" rel="stylesheet">
 <link rel="stylesheet" media="screen" type="text/css" href="css/style.css"/>


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

<div class=" center-block col-md-12" >
  
  
  
	<form class="form-horizontal" method="post" action="#">
			
		<div  class="col-md-4  col-md-offset-1">
			
			<div class="form-group">
				<label >Ajouter un cours</label>
				<div class="form-group">
				<label >Nom du cours (obligatoire)</label>
				<input type="text" required  name="nom_cours" class="form-control"  placeholder="Entrez un numero de groupe"/>
			  </div>
			  <div class="form-group">
				<label >Coefficient de la matière (obligatoire)</label>
				<input type="text" required name="coefficient" class="form-control"  placeholder="Entrez un chiffre" >
			  </div>
			  <div class="form-group">
				<label >Coefficient du DEV (obligatoire)</label>
				<input type="text" required name="coeffDe_cours" class="form-control"  placeholder="Entrez un chiffre" >
			  </div>
			  <div class="form-group">
				<label >Coefficient du COM (si il y en a un)</label>
				<input type="text" name="coeffCe_cours" class="form-control"  placeholder="Entrez un chiffre"  >
			  </div>
			  <div class="form-group">
				<label >Coefficient du Projet (si il y en a un)</label>
				<input type="text" name="coeffPrj_cours" class="form-control"  placeholder="Entrez un chiffre"  >
			  </div>
			   <div class="form-group">
				<label >Coefficient du TP (si il y en a un)</label>
				<input type="text" name="coeffTp_cours" class="form-control"  placeholder="Entrez un chiffre"  >
			  </div>
			 
			
			  <div class="form-group">
				<label >Numero du professeur</label>
				<input type="text" name="num_prof" class="form-control" value = "1" placeholder="Entrez le numero du professeur de ce cours" >
			  </div>
			
			  
			  
				<button type="submit" name="add_cours" class="btn btn-default">Ajouter</button>				
			  </div>			    				
		</div>
			 
		
			  
			  
		
		</div>  
			
	</form>
  
  


</div>


<?php

	
			
			
				include("connexion_bdd.php");
				

			$req_search = "SELECT * FROM cours";
				
			try{	
			$req_search = $pdo->query($req_search);
			
			}
			catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					
				}

			$req_search->setFetchMode(PDO::FETCH_OBJ);
			
			
			echo("<div class=' center-block col-md-12' ><p><h2> Les differents cours créée sont:</p></h2><div>");
			while ($result=$req_search->fetch())
			{
			
			echo("<div  class='col-md-4  col-md-offset-1'><p><tr><td><h4> Cours: " . $result->nom_cours . "</h4></td></tr><p></div>
			<div  class='col-md-4  col-md-offset-1'><p><tr><td> Identifiant du cours: ". $result->id_cours . "</td></tr><p></div>");
			echo("<div  class='col-md-4  col-md-offset-1'><td><a href='majCours.php?id=" . $result->id_cours . "' alt='MàjCours' title='Mise à jour'>Mettre à jour ce cours</a></td></tr></div></br>");
			}
			
			
			 if(isset($_POST["add_cours"]))
			 {
				
				$nom = $_POST['nom_cours'];
				$coef = $_POST['coefficient'];
				$DE = $_POST['coeffDev_cours'];
				if(!empty($_POST['coeffCom_cours'])){
				$CE = $_POST['coeffCom_cours'];
				}
				else{
					$CE = 0;
				}
				if(!empty($_POST['coeffPrj_cours'])){
				$PRJ = $_POST['coeffPrj_cours'];
				}
				else{
					$PRJ = 0;
				}
				if(!empty($_POST['coeffTp_cours'])){
				$TP = $_POST['coeffTp_cours'];		
				}
				else{
					$TP = 0;
				}
				
				$num_prof = $_POST['num_prof'];
				
				 
				 
				
				try { 
				$requete="INSERT INTO `cours` (`nom_cours`,`coefficient` ,`coef_TP`,`coef_PRJ`,`coef_Dev`,`coef_Com`,`id_prof`) VALUES ('$nom','$coef', '$TP','$PRJ','$Dev','$Com','$num_prof')";
					$pdo->query($requete);
							
					
							
				}
									
				catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					echo $msg;
							
				}
				/*
				BUG DE FDP QUI N'A AUCUN SENS DONC INUTILISABLE
				header("Refresh:0");
				*/
			}

	
	
	

	
	
?>

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>