<?php
session_start();

$title = $_POST['EventTitle'];
$date = $_POST['EventDate'];
$price = $_POST['Price'];
$imageurl = $_POST['ImageURL'];
$description = $_POST['Description'];

$bdd = new PDO('mysql:host=localhost; dbname=projetweb; charset=utf8', 'root', '');
/*
if(isset($_POST['id'])) {
	
	$IDIdea = $_POST['id'];
	$GetMail = $bdd->prepare("SELECT Email FROM Users INNER JOIN Ideas ON Users.IDUser = Ideas.IDUser WHERE IDIdea = ?");
	$GetMail->execute(array($IDIdea));
	$UserMail = $GetMail->fetch();
	$GetMail->closeCursor();
	
	//mail('matthis.moyon@viacesi.fr', 'Votre proposition a été sélectionnée !', 'Félicitation ! Votre proposition a été sélectionnée par un membre du BDE qui a créé un événement à partir de celle-ci. Venez vite voir le résultat sur le site du BDE CESI Saint-Nazaire !');
	
} else {}
*/

		$CreateEvent = $bdd->prepare("INSERT INTO Events (Name, EventDate, Price, UrlImage, Description, Selected) VALUES( :Name, :Date, :Price, :UrlImage, :Description, 0) ");
		
		$CreateEvent->bindValue(':Name', $title, PDO::PARAM_STR);
		$CreateEvent->bindValue(':Date', $date, PDO::PARAM_STR);
		$CreateEvent->bindValue(':Price', $price, PDO::PARAM_STR);
		$CreateEvent->bindValue(':UrlImage', $imageurl, PDO::PARAM_STR);
		$CreateEvent->bindValue(':Description', $description, PDO::PARAM_STR);
		
		$CreateEvent->execute();
		
		/*
		$DeleteProposition = $bdd->prepare("DELETE FROM Ideas WHERE IDIdea = ? ");
		$DeleteProposition->execute(array($));
		*/
		
		//echo '<meta http-equiv="refresh" content="0;URL=BoiteAIdees.php">';
	}else{
	//echo '<meta http-equiv="refresh" content="0;URL=AjoutEvenement.php">';
	}
	*/

?>