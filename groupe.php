<?php

session_start();
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
			
		<div  class="col-md-4  col-md-offset-1">
			
				<div class="form-group">
				<label >Numero du groupe</label>
				<input type="text" name="num_groupe" class="form-control"  placeholder="Entrez un numero de groupe"  >
			  </div>
			  
			  <div class="hidden">
			  <div class="form-group">
				<label >ID Admin</label>
				<input type="text" name="num_admin" class="form-control" value = "1" placeholder="Entrez le numero de l'administrateur" >
			  </div>
			  </div>
			  
			  
				<button type="submit" name="add_group" class="btn btn-default">Ajouter</button>				
			  </div>			    				
		</div>
			 
		
			  
			  
		
		</div>  
			
	</form>
  
  


</div>


<?php

	 
			
			include("connexion_bdd.php");
				
			
			echo("<div class=' center-block col-md-12' ><p><h2> Vous trouverez ici les elèves n'ayant pas de groupes:</p></h2></div>
			<div  class='col-md-4  col-md-offset-1'><a href='majNoGroup.php' alt='Eleve sans groupe' title='Elèves sans groupes'>Liste des élèves sans groupes</a></td></tr></div></div></br>");
			echo("<div class=' center-block col-md-12' ><p><h2> Les differents groupes actuellement créés sont:</p></h2></div>");
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
			echo("<div  class='col-md-4  col-md-offset-1'><p><tr><td> Groupe " . $result->num_groupe . "</td></tr><p></div>");
			echo("<div  class='col-md-4  col-md-offset-1'><td><a href='majGroupe.php?id=" . $result->num_groupe . "' alt='Màj' title='Mise à jour'>Mettre à jour ce groupe</a></td></tr></div></br>");
			echo("<div  class='col-md-4  col-md-offset-1'><td><a href='delete.php?id=" . $result->num_groupe . "' alt='Màj' title='Suppression'>Supprimer ce groupe</a></td></tr></div></div></br>");
			}
			}
			
			
			
			
			if(isset($_POST["add_group"]))
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