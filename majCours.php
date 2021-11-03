<?php

session_start();


if (isset($_GET['id']))
{
		$id=$_GET['id'];
}

	include("connexion_bdd.php");
				
				$req_nomCour="SELECT * FROM cours WHERE id_cours='$id'";
				
				$req_nomCour = $pdo->query($req_nomCour);
				
				$req_nomCour->setFetchMode(PDO::FETCH_OBJ);
				
				$nomCours;
				while ($result=$req_nomCour->fetch())
			{
			$nomCours=$result->nom_cours;
			}
?>






<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Mettre à jour un Cours</title>


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
	
			<?php include("navigation.php");?>
				
		</header>
					<!--CONTENU DE LA PAGE -->

<div class=" center-block col-md-12" >

<?php echo("<p><h1> Mise à jour du cours:".$nomCours."</h1></p>");?>
  
  
  
<form class="form-horizontal" method="post" action="#">
  <div class="form-group">
				<label >Numero du groupe à inscrire</label>
				<input type="text" name="num_groupe" class="form-control"  placeholder="Entrez un numero de groupe à ajouter à ce cours"  >
			  </div>
  <button type="submit" name="add_group" class="btn btn-default">Ajouter</button>			
  


</div>


<?php

			
			
			echo("<div class=' center-block col-md-12' ><p><h2> Les differents groupes inscrits à ce cours sont:</p></h2><div>");
				$req_searchInscrit = "SELECT num_groupe FROM suit WHERE id_cours='$id'";
				$req_searchInscrit = $pdo->query($req_searchInscrit);

			$req_searchInscrit->setFetchMode(PDO::FETCH_OBJ);

			while ($resultInscrit=$req_searchInscrit->fetch()){
				echo("<div  class='col-md-4  col-md-offset-1'>
			<p><tr><td> Groupe Inscrit: " . $resultInscrit->num_groupe . "</td></tr></p>
			</div></div>");
				
				
			}
			
			echo("<div class=' center-block col-md-12' ><p><h2> Les differents groupes existant sont:</p></h2><div>");
			$req_search = "SELECT * FROM groupe";
				
			$req_search = $pdo->query($req_search);

			$req_search->setFetchMode(PDO::FETCH_OBJ);

			while ($result=$req_search->fetch())
			{
				
			if($result->num_groupe == 99){
			echo("<div  class='hidden'><p><tr><td> Groupe " . $result->num_groupe . "</td></tr><p></div>");
			echo("<div  class='hidden'><td><a href='majGroupe.php?id=" . $result->num_groupe . "' alt='Màj' title='Mise à jour'>Mettre à jour ce groupe</a></td></tr></div></br>");
			echo("<div  class='hidden'><td><a href='delete.php?id=" . $result->num_groupe . "' alt='Màj' title='Suppression'>Supprimer ce groupe</a></td></tr></div></div></br>");
			}
			else{
			echo("<div class=' center-block col-md-12' ></br><form class='form-horizontal' method='post' action='#'>
			<div  class='col-md-4  col-md-offset-1'>
			<p><tr><td> Groupe: " . $result->num_groupe . "</td></tr></p>
			</div></div>");
			echo("<div class='form-group'>");
			}
			}
			
			if(isset($_POST["add_group"]))
			{
				
			$num_groupe=$_POST['num_groupe'];
			
			$requete_groupe="INSERT INTO `suit`(`num_groupe`,`id_cours`) VALUES ('$num_groupe','$id')";
			
			$requete_eleves="SELECT * FROM eleve WHERE num_groupe='$num_groupe'";
			
			
			try{
			$pdo->query($requete_groupe);
			
			$requete_eleves = $pdo->query($requete_eleves);
				
			$requete_eleves->setFetchMode(PDO::FETCH_OBJ);
			
			
			
				while ($result=$requete_eleves->fetch())
				{
				$numEleve=$result->matricule;
				$requete_evaluation="INSERT INTO evalue (`id_cours`,`matricule`) VALUES ('$id','$numEleve')";
				$pdo->query($requete_evaluation);
				}
			
			
			header("refresh:0;url=majCours.php?id=".$id);
			}
			
			
			
			
			
			/*try{
				$requete_cours="SELECT * FROM suit WHERE num_groupe = '$groupe'";
				
				$pdo->query($requete_groupe);
			
				$requete_cours = $pdo->query($requete_cours);
				
				$requete_cours->setFetchMode(PDO::FETCH_OBJ);
				
				
				while ($resultCours=$requete_cours->fetch())
				{
				$numCours=$resultCours->id_cours;
				$requete_evaluation="INSERT INTO evalue (`id_cours`,`matricule`) VALUES ('$numCours','$nom')";
				$pdo->query($requete_evaluation);
				}*/
			

				
			
			catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					echo $msg;
							
				}
			
			}
		
	
	
	

	
	
?>

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>