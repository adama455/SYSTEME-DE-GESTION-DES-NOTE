<?php

session_start();

if (isset($_GET['id']))
{
		$id=$_GET['id'];
}

if (isset($_GET['mat']))
{
		$matricule=$_GET['mat'];
}


				include("connexion_bdd.php");


				$req_nomCour="SELECT * FROM cours WHERE id_cours='$id'";
				
				$req_nomCour = $pdo->query($req_nomCour);
				
				$req_nomCour->setFetchMode(PDO::FETCH_OBJ);
				
				$nomCours;
				while ($resultCours=$req_nomCour->fetch())
				{
				$nomCours=$resultCours->nom_cours;
				}

				
				
				$req_nomEleve="SELECT * FROM eleve WHERE matricule='$matricule'";
				
				$req_nomEleve = $pdo->query($req_nomEleve);
				
				$req_nomEleve->setFetchMode(PDO::FETCH_OBJ);
				
				$nomEleve;
				while ($result=$req_nomEleve->fetch())
				{
				$nomEleve=$result->nom_eleve;
				}
				
				//Récupérer les coefficient afin de masquer l'affichage des coefficient nul
				$coefDE;
				$coefCE;
				$coefPRJ;
				$coefTP;
				
				$req_coef="SELECT * FROM cours WHERE id_cours='$id'";
				
				$req_coef = $pdo->query($req_coef);
				
				$req_coef->setFetchMode(PDO::FETCH_OBJ);
				
				
				while ($resultCoef=$req_coef->fetch())
				{
				$coefDE = $resultCoef->coef_Dev;
				$coefCE = $resultCoef->coef_Com;
				$coefPRJ = $resultCoef->coef_PRJ;
				$coefTP = $resultCoef->coef_TP;
				}
				
				

?>






<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>

<meta http-equiv="Content-type" content="text/html" charset="UTF-8" />
<title> Mettre des notes d'un elève</title>


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

<?php echo("<h2>Modifier les notes de ".$nomEleve." pour le cours ".$nomCours."</h2>");?>
  
  
  

  
  
  


</div>


<?php

			
			
		
				
				
			
			echo("<div class=' center-block col-md-12' ><p><h3> Les differentes notes de cet elève pour ce cours sont:</p></h3><div>");
			$req_NotesEleves="SELECT * FROM evalue WHERE id_cours='$id' AND matricule='$matricule'";
				
				$req_NotesEleves = $pdo->query($req_NotesEleves);
				
				$req_NotesEleves->setFetchMode(PDO::FETCH_OBJ);
				
				
				while ($result=$req_NotesEleves->fetch())
				{
					$note_DE=$result->note_DE;
					
					$note_CE=$result->note_CE;
					
					$note_TP=$result->note_TP;
					
					$note_PRJ=$result->note_PRJ;
				
					echo("<div class='center-block col-md-12' ></br><form class='form-horizontal' method='post' action='#'>
					<div  class='col-md-4  col-md-offset-1'>");
				echo("Les notes de cet elève sont: </br> DE:");
				echo("<input type='text' name='DE' value='$note_DE' id='DE_input'/>");
				if($note_DE == NULL){
						echo("Pas encore saisie");
					}
					else{
					 echo("</br>Actuellement cet elève a eu: ".$note_DE."</br>");
					}
				if($coefCE == 0){
				echo("<input type='text' class='hidden' name='CE' value='$note_CE' id='CE_input'/>");
				}
				else{				
				echo("</br> CE:");
				echo("<input type='text' name='CE' value='$note_CE' id='CE_input'/>");
				if($note_CE == NULL){
						echo("Pas encore saisie");
					}
					else{
					 echo("</br>Actuellement cet elève a eu: ".$note_CE."</br>");
					}
				}
				if($coefPRJ == 0){
				echo("<input type='text' class='hidden' name='PRJ' value='$note_PRJ' id='PRJ_input'/>");
				}
				else{	
				echo("</br> Projet:");
				echo("<input type='text' name='PRJ' value='$note_PRJ' id='PRJ_input'/>");
				if($note_PRJ == NULL){
						echo("Pas encore saisie");
					}
					else{
					 echo("</br>Actuellement cet elève a eu: ".$note_PRJ."</br>");
					}
				}
				if($coefTP == 0){
				echo("<input type='text' class='hidden' name='TP' value='$note_TP' id='TP_input'/>");
				}
				else{	
				echo("</br> TP:");
				echo("<input type='text' name='TP' value='$note_TP' id='TP_input'/>");
				if($note_TP == NULL){
						echo("Pas encore saisie</br>");
					}
					else{
					 echo("</br>Actuellement cet elève a eu: ".$note_TP."</br>");
					}
				}
				echo("<button type='submit' name='submit_note' class='btn btn-default'>Confirmer les notes</button></form>");	
				
				}
				
				if(isset($_POST["submit_note"]))
			 {
				
				$note_DE_saisie = $_POST['DE'];
				$note_CE_saisie =  $_POST['CE'];
				$note_TP_saisie = $_POST['TP'];
				$note_PRJ_saisie = $_POST['PRJ'];
				try { 
				$requete="UPDATE evalue SET note_DE = '$note_DE_saisie', note_CE = '$note_CE_saisie',note_TP = '$note_TP_saisie',note_PRJ = '$note_PRJ_saisie' WHERE matricule = '$matricule' AND id_cours = '$id'"; 
												
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