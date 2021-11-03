<?php

session_start();

?>






<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Affecter un groupe </title>


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

<?php echo("<p><h1> Mise à jour des élèves sans groupe</h1></p>");?>
  
  
  

  
  
  


</div>


<?php


			
			
				include("connexion_bdd.php");
				
				
			
			echo("<div class=' center-block col-md-12' ><p><h2> Les differents élèves du groupes sont:</p></h2><div>");
			$req_search = "SELECT * FROM eleve WHERE Num_groupe='99'";
				
			$req_search = $pdo->query($req_search);

			$req_search->setFetchMode(PDO::FETCH_OBJ);

			while ($result=$req_search->fetch())
			{
			echo("<div class=' center-block col-md-12' ></br><form class='form-horizontal' method='post' action='#'>
			<div  class='col-md-4  col-md-offset-1'>
			<p><tr><td> Eleve: " .$result->prenom_eleve ."  ". $result->nom_eleve .  "</td></tr></p>
			</div></div>");
			echo("<div class='form-group'>
			<label >Nouveau groupe</label>
			<input type='text' name='num_groupe' class='form-control'  placeholder='Entrez un numero du groupe vers lequel déplacer cet élève'/></div>");
			echo("<div class='form-group'>
			<input type='text' name='nom' class='hidden_input' value='$result->matricule' id='nom_input'/></div>");
			echo("<button type='submit' name='deplace' class='btn btn-default'>Deplacer</button></div></form><div class=' center-block col-md-12' ></div>");
			}
			
			if(isset($_POST["deplace"]))
			{
			$nom=$_POST['nom'];
			$groupe = $_POST['num_groupe'];
			$requete_groupe="UPDATE eleve SET num_groupe = '$groupe' WHERE matricule = '$nom'";
			$requete_cours="SELECT * FROM suit WHERE num_groupe = '$groupe'";
			try{
				$pdo->query($requete_groupe);
			
				$requete_cours = $pdo->query($requete_cours);
				
				$requete_cours->setFetchMode(PDO::FETCH_OBJ);
				
				
				while ($resultCours=$requete_cours->fetch())
				{
				$numCours=$resultCours->id_cours;
				$requete_evaluation="INSERT INTO evalue (`id_cours`,`matricule`) VALUES ('$numCours','$nom')";
				$pdo->query($requete_evaluation);
				}
			
			


			}
			
			catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					echo $msg;
							
				}
				
				header("refresh:0;url=majNoGroup.php");
			
			}
		
	
	
	

	
	
?>

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>