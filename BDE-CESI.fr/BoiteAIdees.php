
	<?php session_start(); ?>

	<?php include('header.php'); ?>
	
	<?php
	function ShowActivities() {
		
	echo('<div class="ideavote">
		<h3 class="BAIh3" >Voter pour une idée</h3>');
		
		$bdd = new PDO('mysql:host=localhost; dbname=projetweb; charset=utf8', 'root', '');
		
		$ActivitesList = $bdd->prepare("
			SELECT Ideas.IDIdea,Activity,LastName,FirstName,COUNT(vote.IDUser)
			FROM Ideas
			INNER JOIN Users ON Users.IDUser = Ideas.IDUser
			INNER JOIN Vote ON Ideas.IDIdea = vote.IDIdea
			WHERE IdeaFlag=false
			GROUP BY vote.IDIdea
			");
			
		$ActivitesList->execute();
		
		
		foreach($ActivitesList as $ans){
			echo '<div class="vote">';
				echo "<p class='IdeeName'>".$ans[3]." ".$ans[2]."</p>";
				echo "<p class='IdeeContent'>".$ans[1]."</p>";
				
					
					echo "<p class='IdeeVotes'>Déjà ".$ans[4]." personnes ont voté pour cette proposition !</p>";
					
					
					echo("<form method='get' action='scriptVote.php'>");
					echo("<input type='text' name='idea' value='".$ans[0]."' style='display:none;'/>");
					echo("<button type='submit' class='votefor'>Voter pour cette proposition</button></form>");
			
					if(($_SESSION['Status']==2)||($_SESSION['Status']==3)){
						
						echo("<form method='get' action='scriptSignalement.php'>");
						echo("<input type='text' name='type' value='Idea' style='display:none;'/>");
						echo("<input type='text' name='id' value='".$ans[0]."' style='display:none;'/>");
						echo("<button type='submit' class='signal'>Signaler comme inapproprié</button></form>");
						
					}
					
					if($_SESSION['Status']==3){
						
						echo("<form method='post' action='AjoutEvenement.php'>");
						echo("<input type='text' name='id' value='".$ans[0]."' style='display:none;'/>");
						echo("<button type='submit' class='createevent'>Créer un événement</button></form>");
					} 
				
			echo ('</div>');
		}
	echo ('</div>');
	}
	
	function ShowForm() {
		
			echo ('<div class="proposition">
					<h3 class="BAIh3" >Proposer une activité</h3>
					<form  method="post" action="scriptProposition.php" autocomplete="on">  
					<p>
					<textarea id="Activity" name="Activity" required="required" rows="10" cols=1000 placeholder="Décrivez votre activité"></textarea>
					</p>
					<p class="Confirm button"> 
					<button id="propose" type="submit">Soumettre ma proposition</button>
					</p>
					</form>
					</div>');

	}
	
	?>
	
<!--####################################
 Auteur : Groupe 3 (Moyon Matthis, Pasquet Vincent, Chéraud Florentin, Amaury Vincent)
 Date : 2018
 Contexte : Projet WEB Exia CESI Saint-Nazaire
 #######################################-->
 
	
<section id="BoiteAIdees">
	<div id="banniere">	
		<h2>Boîte à idées</h2>
	</div>

	
	<div id="sectionidees">

		<?php if(isset($_SESSION['Status'])){
			ShowForm();
			ShowActivities();
		} else{echo "<p class='disconnected'>Vous devez être connecté pour pouvoir participer ou proposer une idée</p>";} ?>

	</div>
</section>

	<?php include('footer.php'); ?>
	
