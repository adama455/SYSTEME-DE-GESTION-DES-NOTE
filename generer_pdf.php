<?php
/*
 * Générer un PDF à partir d'une base de données
 */

session_start();
//include("navigation.php");

/*
 * Début de la temporisation de sortie
 */
ob_start();
?>

<page backtop="5%" backbottom="5%" backleft="5%" backright="5%">
    
   <style> 



td
{
padding:10px;
}
</style>

<img style="width:150px; display:inline-block;" src="logo.png"/> <img style="margin-left:300px;display:inline-block;" src="efrei.png"/>

	<h2 style="margin-top:50px;">Bulletin de notes   </h2>  
	<h4> Identifiant : <?php if(isset($_SESSION['identifiant'])){echo $_SESSION['identifiant']; }?></h4>			
<table border="2" >
			
			<!-- NOM DES COURS-->
			<?php 
			
				if(isset($_SESSION['identifiant']))
				{
				
				echo "<tr>";		
					include("connexion_bdd.php");
					$identifiant=$_SESSION['identifiant'];
					$requete=" SELECT NOM_COURS,note_DE,note_PRJ,note_CE,note_TP FROM COURS A, EVALUE C WHERE A.id_cours=C.id_cours AND C.matricule=$identifiant ";
					try { 
							$result = $pdo->query($requete);
							$result->setFetchMode(PDO::FETCH_OBJ); 
					
							while ($data = $result->fetch()) {
							$nom_cours=$data->NOM_COURS ;
							$note_DE=$data->note_DE ;
							$note_PRJ=$data->note_PRJ ;
							$note_CE=$data->note_CE ;
							$note_TP=$data->note_TP ;
							
							echo "<tr>";		
							echo"<td> <b>$nom_cours</b></td>";
							
							echo"<td> <b>DE : $note_DE</b></td>";
							
							
							echo"<td> <b>PROJET : $note_PRJ</b></td>";
							
							
							echo"<td> <b>CE : $note_CE</b></td>";
							
							
							echo"<td> <b>TP : $note_TP</b></td>";	
							
							echo "</tr>";	

							
													
							}
						}
			
					catch(PDOException $e2) {
					$msg ='ERREUR PDO dans ' . $e2->getFile() . ' Ligne ' . $e2->getLine() . ' : ' . $e2->getMessage(); 
					echo $msg;
					}
			echo "</tr>";			
			
				}
				
				else
				{
				header("refresh:0;url=index.php");
				}
			?>
			
										
							
</table >
</page>

<?php

/*
 * $content récupére toutes les données mises en mémoire. 
 */

$content = ob_get_clean();

require('html2pdf/html2pdf.class.php');

/*
 * On instancie notre constructeur
 * On affiche le contenu
 * On génére notre PDF 
 */

$pdf = new HTML2PDF('P','A4','fr','true','UTF-8');
$pdf->writeHTML($content);
//$pdf->pdf->IncludeJS('print(true)');
$pdf->Output('liste.pdf');

?>