<?php

session_start();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Accueil</title>


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
				
				<ul class="nav nav-tabs "
					<li role="presentation"  style="text-align:center;"> <img style="margin-left:50px" src="itecom.png"/> </li>
				</ul>
			<?php include("navigation.php"); ?>
				
		</header>

					<!--CONTENU DE LA PAGE -->
					
	<?php
	if(!isset($_SESSION["type"]))
	
	{
	
	?>
	<form class="form-horizontal" method="post" action="#">
			
		<div  class="col-md-4  col-md-offset-1">
			
			<div class="form-group">
				<label >Identifiant </label>
				<input type="text" name="identifiant" class="form-control"  placeholder="Entrez votre identifiant"  > 
			  </div>
			  <div class="form-group">
				<label >Mot de passe</label>
				<input type="password" name="mot_de_passe" class="form-control"  placeholder="Entrez votre mot de passe "  >
			  </div>
			  
			  	<button type="submit" name="connexion" class="btn btn-default">Connexion</button>
				
				<!-- <h3 ><a target="_blank"href="mcd.png">Lien vers le MCD</a> </h3>
							
				<h3><a target="_blank" href="mld.png">Lien vers le MLD</a> </h3> -->
		</div>
			 

		</div>  
			
	</form>
	
	<?php
	}
	else
	{
	?>
	<div class="form-group" style="margin:50px;">
				<label > <h2>Vous êtes connecté en tant <?php if($_SESSION['type']=="eleve" || $_SESSION['type']=="admin"){echo "qu'".$_SESSION['type'];} else{echo "que ".$_SESSION['type'];}?></h2> </label>
				<!-- <h3 ><a target="_blank"href="mcd.png">Lien vers le MCD</a> </h3> -->
				
	 <!-- <h3><a target="_blank" href="mld.png">Lien vers le MLD</a> </h3> -->
			  </div>
	<?php
	}
	?>
		<?php
	
	 if(isset($_POST["connexion"]))
 
 {


	$identifiant_bis="null";
	$identifiant=$_POST["identifiant"];
	$mot_de_passe= $_POST["mot_de_passe"];

	include("connexion_bdd.php");
	
		$requete=" SELECT IDENTIFIANT FROM COMPTE WHERE MOT_DE_PASSE='$mot_de_passe' ";
			try { 
					$result = $pdo->query($requete);
					$result->setFetchMode(PDO::FETCH_OBJ); 
			
					while ($data = $result->fetch()) {
					$identifiant_bis=$data->IDENTIFIANT ;
					}
				}
				
			catch(PDOException $e2) {
			$msg ='ERREUR PDO dans ' . $e2->getFile() . ' Ligne ' . $e2->getLine() . ' : ' . $e2->getMessage(); 
			echo $msg;
				}
			
		if($identifiant==$identifiant_bis)
		
				{
				
				$_SESSION['identifiant']=$identifiant_bis;
				$requete=" SELECT  TYPE FROM COMPTE WHERE IDENTIFIANT='$identifiant_bis' ";
					try { 
						$result = $pdo->query($requete);
						$result->setFetchMode(PDO::FETCH_OBJ); 
					
							while ($data = $result->fetch()) {
							$_SESSION['type']=$data->TYPE ;
							}
				
						}
					catch (Exception $e_2) {
					$msg ='ERREUR PDO dans ' . $e2->getFile() . ' Ligne ' . $e2->getLine() . ' : ' . $e2->getMessage(); 
					echo $msg;
					
					 }
				header("refresh:0;url=index.php");
				$type= $_SESSION['type'] ;
				
				}
				
		
		else
				{
		
					
				}
	}
	?>	
	
	

		
	

		
<footer > 

 
 
			
</footer>
	
	
	
	


	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js" type="text/javascript"></script>
		

</body>

</html>