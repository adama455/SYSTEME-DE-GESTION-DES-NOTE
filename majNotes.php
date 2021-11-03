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
<title> Ajouter un groupe</title>


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
			
		<div  class="col-md-11  col-md-offset-1">
			
				
				<?php echo("<h2>Modifier les notes d'un groupe pour le cours :".$nomCours."</h2>");?>
						    				
		</div>
			 
		
			  
			  
		
		</div>  
			
	</form>
  
  


</div>


<?php

	 
			
			
		
				
			
			echo("<div class=' center-block col-md-12' ><p><h4> Vous trouverez ici les différents groupes inscrits à ce cours:</p></h4></div>");
			$req_search = "SELECT * FROM suit WHERE id_cours='$id'";
				
			$req_search = $pdo->query($req_search);

			$req_search->setFetchMode(PDO::FETCH_OBJ);

			while ($result=$req_search->fetch())
			{
			echo("<div  class='col-md-4  col-md-offset-1'><p><h4>Groupe " . $result->num_groupe . "</h4><p></br>");
			echo("<a href='majNotesEleve.php?id=".$result->id_cours."&num=".$result->num_groupe."' alt='Màj' title='Mise à jour'>Modifier les notes de ce groupe</a></br></div>");
			}
			
			
			
			
			if(isset($_POST["enter_group"]))
			 {
				
				$num_groupe = $_POST['num_groupe'];
				$num_admin =  $_POST['num_admin'];
				try { 
				$requete="INSERT INTO `groupe`(`num_groupe`,`id_admin`) 
												VALUES ('$num_groupe','$num_admin')";
					$pdo->query($requete);
					header("Refresh:0");
				}
				
				
							
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