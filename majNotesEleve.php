<?php

session_start();


if (isset($_GET['id']))
{
		$id=$_GET['id'];
}

if (isset($_GET['num']))
{
		$num=$_GET['num'];
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
				
				$req_nomGroupe="SELECT * FROM groupe WHERE num_groupe='$num'";
				
				$req_nomGroupe = $pdo->query($req_nomGroupe);
				
				$req_nomGroupe->setFetchMode(PDO::FETCH_OBJ);
				
				$nomGroupe;
				while ($result=$req_nomGroupe->fetch())
				{
				$nomGroupe=$result->num_groupe;
				}
				

?>






<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Mettre à jour un groupe</title>


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

<?php echo("<h2>Modifier les notes du groupe ".$nomGroupe." pour le cours ".$nomCours."</h2>");?>
  
  
  

  
  
  


</div>


<?php

			
			
		
				
				
			
			echo("<div class=' center-block col-md-12' ><p><h3> Les differents elèves de ce groupe sont:</p></h3><div>");
			$req_search = "SELECT * FROM eleve WHERE Num_groupe=$num AND bulletin=0 ";
				
			$req_search = $pdo->query($req_search);

			$req_search->setFetchMode(PDO::FETCH_OBJ);

			while ($result=$req_search->fetch())
			{
			echo("<div class='center-block col-md-12' ></br><form class='form-horizontal' method='post' action='#'>
			<div  class='col-md-4  col-md-offset-1'>
			<p><tr><td> Eleve: " . $result->prenom_eleve ."  ".$result->nom_eleve." ".$result->date_naissance. "</td></tr></p>
			</div></div>");
			echo("<div class='form-group' >");
			echo("<div class='form-group'>
			<input type='text' name='nom' class='hidden_input' value='$result->matricule' id='nom_input'/></div>");
			echo("<a href='majNotesEleveIndiv.php?id=".$id."&mat=".$result->matricule."' alt='Màj' title='Mise à jour'>Modifier les notes de cet élève</a></br></div>");
			}
			
			
			
			
		
	
	
	

	
	
?>

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>