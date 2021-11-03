<?php

session_start();
try{
				$strConnection = ('mysql:host=localhost;dbname=gestion_note_efrei2');
				$pdo = new PDO($strConnection, 'root', ''); // Instancie la connexion
				$pdo->query("SET NAMES utf8"); // permet de gérer les accents dans MySQL
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//
				}
				catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					
				}
			
		
							
				catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					echo $msg;
							
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
  
  
  
	
			 
		
			  
			  
		
		</div>  
			
	</form>
  
  


</div>


<?php

	 	include("connexion_bdd.php");
			
			
		$req_search = "SELECT * FROM cours";
				
			$req_search = $pdo->query($req_search);

			$req_search->setFetchMode(PDO::FETCH_OBJ);
			
			
			echo("<div class=' center-block col-md-12' ><p><h2> Les differents cours existants sont:</p></h2><div>");
			while ($result=$req_search->fetch())
			{
			
			echo("<div  class='col-md-4  col-md-offset-1'><p><tr><td><h4> Cours: " . $result->nom_cours . "</h4></td></tr><p></div>
			<div  class='col-md-4  col-md-offset-1'><p><tr><td> Identifiant du cours: ". $result->id_cours . "</td></tr><p></div>");
			echo("<div  class='col-md-4  col-md-offset-1'><td><a href='majNotes.php?id=" . $result->id_cours . "' alt='MàjCours' title='Mise à jour'>Mettre à jour les notes ce cours</a></td></tr></div></br>");
			}
	
	
	

	
	
?>

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>