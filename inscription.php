<?php

session_start();
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Ajouter un élève</title>


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
		
			<header>
		
				<!--NAVIGATION -->
	
			<?php include("navigation.php"); ?>
				
		</header>
					<!--CONTENU DE LA PAGE -->

<div class=" center-block col-md-12" >
  
  
  
	<form class="form-horizontal" method="post" action="#">
			
		<div  class="col-md-4  col-md-offset-1">
			
			<div class="form-group">
				<label >Nom</label>
				<input type="text" name="nom" class="form-control"  placeholder="Entrez votre nom"  > 
			  </div>
			  <div class="form-group">
				<label >Prénom</label>
				<input type="text" name="prenom" class="form-control"  placeholder="Entrez votre prénom"  >
			  </div>
			  
			   <div class="form-group">
				<label >Numéro et nom de rue</label>
				<input type="text" name="adresse" class="form-control"  placeholder="Entrez votre adresse"  >
			  </div>
			  
			  <div class="form-group">
				<label >Code postal</label>
				<input type="number" name="code_postal" class="form-control"  placeholder="Entrez votre code postal"  >
			  </div>
			  
			   <div class="form-group">
				<label>Ville</label>
				<input type="text" name="ville" class="form-control"  placeholder="Entrez votre  ville"  >
			  </div>
			  
			  <div class="form-group">
				<label>Téléphone domicile</label>
				<input type="text" name="tel_domicile" class="form-control"  placeholder="Entrez le téléphone de votre domicile"  >
			  </div>
			  
			  <div class="form-group">
				<label>Téléphone mobile</label>
				<input type="text" name="tel_mobile" class="form-control"  placeholder="Entrez votre téléphone mobile"  >
			  </div>
			    
		</div>
			 
		<div  class="col-md-4  col-md-offset-1">  
			 <div class="form-group">
				<label >Date de naissance</label>
				<input type="text" name="date_naissance" class="form-control"  placeholder="Entrez votre date de naissance"  >
			  </div>
			  
			  <div class="form-group">
			  <label >Sexe</label>
				  <div class="radio">
					  <label>
						<input type="radio" name="sexe"  value="masculin" checked>
						Masculin
					  </label>
					  
					  <label>
						<input type="radio" name="sexe" value="feminin" >
						F&eacute;minin
					  </label>
				</div>
			</div>
			
			  
			  <div class="form-group">
				<label >Date d'inscription</label>
				<input type="text" name="date_inscription" class="form-control"  placeholder="Entrez votre date d'inscription"  >
			  </div>
			  
			   <div class="form-group">
				<label >Etablissement précédent</label>
				<input type="text" name="etablissement" class="form-control"  placeholder="Entrez votre précédent établissement"  >
			  </div>
			  
			  <!-- <div class="form-group">
				<label >Vaccinations</label>
				<input type="text" name="vaccinations" class="form-control"  placeholder="Entrez vos vaccins"  >
			  </div> 
			  
			  <div class="form-group">
				<label >allergies</label>
				<input type="text" name="allergies" class="form-control"  placeholder="Entrez vos allergies"  >
			  </div> 
			  
			  <div class="form-group">
				<label >Remarques médicales</label>
				<input type="text" name="remarques" class="form-control"  placeholder="Entrez vos remarques médicales" >
			  </div> -->
			  
			<div  class="hidden">
			  <div class="form-group" >
				<label >Numero de groupe</label>
				<input type="text" name="num_groupe" class="form-control" value = "99" placeholder="Entrez votre numero de groupe" >
			  </div>
			 </div>
			  
			 
			 
			    
			  <div class="form-group">
				<label for="exampleInputFile">Ajouter une photo</label>
				<input type="file" name="photo" id="exampleInputFile">
				<p class="help-block">Ajouter une photo au format .jpg ou .png</p>
				
				<button type="submit" name="inscription" class="btn btn-default">Ajouter</button>
			  </div>
			  
			  
		
		</div>  
			
	</form>
  
  


</div>

<?php

	 if(isset($_POST["inscription"]))
			 {
				
				 $nom = $_POST['nom'];
				 $prenom = $_POST['prenom'];
				 $adresse = $_POST['adresse'];
				 $code_postal = $_POST['code_postal'];
				 $ville = $_POST['ville'];
				 $tel_domicile = $_POST['tel_domicile'];
				 $tel_mobile = $_POST['tel_mobile'];
				 $date_naissance = $_POST['date_naissance'];
				 $sexe = $_POST['sexe'];
				 $date_inscription = $_POST['date_inscription'];
				 $etablissement = $_POST['etablissement'];
				//  $vaccinations = $_POST['vaccinations'];
				//  $allergies = $_POST['allergies'];
				//  $remarques= $_POST['remarques'];
				 $num_groupe = $_POST['num_groupe'];
				 
				 //$photo = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
				
				 
				 
				include("connexion_bdd.php");
				
				try { 
				$requete="INSERT INTO `eleve`(`nom_eleve`, `prenom_eleve`, `adresse`, `code_postal`, `ville`, `tel_domicile`, `tel_mobile`, `date_naissance`, `sexe`, `date_inscription`, `etablissement`, `num_groupe`) 
												VALUES ('$nom','$prenom','$adresse','$code_postal','$ville','$tel_domicile','$tel_mobile','$date_naissance','$sexe','$date_inscription','$etablissement ', '$num_groupe')";
					$pdo->query($requete);
							
				}
							
				catch(PDOException $e) {
					$msg ='ERREUR PDO dans ' . $e->getFile() . ' Ligne ' . $e->getLine() . ' : ' . $e->getMessage(); 
					echo $msg;
							
				}
				
				$requete="SELECT * FROM eleve ORDER BY matricule DESC LIMIT 1 ";
					try { 
							$result = $pdo->query($requete);
							$result->setFetchMode(PDO::FETCH_OBJ); 
					
							while ($data = $result->fetch()) {
							$matricule=$data->matricule ;
								try { 
								$requete2="INSERT INTO `compte`(`identifiant`,`mot_de_passe`,`type`) VALUES ('$matricule','$matricule','eleve')";
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