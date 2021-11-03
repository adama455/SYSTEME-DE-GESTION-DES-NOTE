
<?php
					if(!isset($_SESSION["type"]) && basename($_SERVER['PHP_SELF'])!="index.php")
					{
					?>
					
					<script> alert('Vous devez vous connecter');</script>
					<?php
					header("refresh:0;url=index.php");
					}
?>
<ul class="nav nav-tabs">
	<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="index.php"){ ?> class="active"<?php } ?>><a href="index.php"> Accueil </a></li>
<?php
					if(isset($_SESSION["type"]))
					{
					
						if($_SESSION["type"]=="admin")
						{
						?>
						<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="inscription.php"){ ?> class="active"<?php } ?>><a href="inscription.php">Ajouter un élève</a></li>
						<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="groupe.php"){ ?> class="active"<?php } ?>><a href="groupe.php">Gestion des groupes</a></li>
						<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="cours.php"){ ?> class="active"<?php } ?>><a href="cours.php">Gestion des cours</a></li>
						<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="notes.php"){ ?> class="active"<?php } ?>><a href="notes.php">Gestion des notes</a></li>
						<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="valider_bulletin.php"){ ?> class="active"<?php } ?>><a href="valider_bulletin.php">Gestion des bulletins</a></li>
						<?php
						
						}
						
						if($_SESSION["type"]=="professeur")
						{
						?>						
						<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="notes.php"){ ?> class="active"<?php } ?>><a href="notes.php">Gestion des notes</a></li>
						<?php
						
						}
						
						if($_SESSION["type"]=="eleve")
						{
						?>
						<li role="presentation"<?php if(basename($_SERVER['PHP_SELF'])=="consulter_note.php"){ ?> class="active"<?php } ?>><a href="consulter_note.php">Consulter note</a></li>
						<?php
						
						}
						?>
						
						<li role="presentation"><a href="deconnexion.php">Se déconnecter</a></li>
						
						<?php
						
						
								
					}
?>


			
				
				
					
					
				
					
</ul>


