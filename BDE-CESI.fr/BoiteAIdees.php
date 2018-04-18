
	<?php session_start(); ?>
	<head>
	<link rel="stylesheet" href="css/BoiteAIdees.css"/>
	</head>
	<?php include('header.php'); ?>
	

<!--####################################
 Auteur : Groupe 3 (Moyon Matthis, Pasquet Vincent, Chéraud Florentin, Amaury Vincent)
 Date : 2018
 Contexte : Projet WEB Exia CESI Saint-Nazaire
 #######################################-->
 
	
<content id="BoiteAIdees">
	<div id="banniere">	
		<h2>Boite à idées</h2>
	</div>	

	
	<section id="sectionidees">
		<div class="proposition">
			<h3>Proposer une activités</h3>
				<?php if(isset($_SESSION['Status'])){} else{echo "<p>Vous devez être connecté pour pouvoir participer ou proposer une idée</p>"; } ?>
				<form  method="post" action="scriptProposition.php" autocomplete="on">  
				<p> 
					<textarea id="Activity" name="Activity" required="required" type="Activity" rows="10" cols=80% placeholder="Décrivez votre activité"></textarea>
				</p>
				<p class="Confirm button"> 
					<button id="propose" type="submit">Soumettre ma proposition</button>
				</p>
		</div>
		<div class="ideavote">
			<h3>Voter pour une idées</h3>
		<?php
			$bdd = new PDO('mysql:host=localhost; dbname=projetweb; charset=utf8', 'root', '');
			$requete = $bdd->prepare("SELECT Activity,LastName,FirstName FROM Ideas INNER JOIN Users ON Users.IDUser = Ideas.IDUser WHERE IdeaFlag=false");
			$requete->execute();
			foreach($requete as $ans){
				echo '<div>';
					echo "<p class='IdeeName'>".$ans[2]." ".$ans[1]."</p>";
					echo "<p class='IdeeContent'>".$ans[0]."</p>";
					if(isset($_SESSION['Status'])){ 
						echo "<button>Voter pour cette idée</button>";
						if($_SESSION['Status']==2) echo "<button>Signaler comme inapproprié</button>";
						if($_SESSION['Status']==3) echo "<button>Créer un événement</button>";
					}
				echo "</div>";
			}
		?>
		</div>
	</section>
</content>

	<?php include('footer.php'); ?>
	