<?php
	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8','root','');
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$requeteConnexion = $bdd->prepare("SELECT * FROM users WHERE Email=? AND Password=?");
	$requeteConnexion->execute(array($Email,$Password));
				
				
		if(!$requeteConnexion->execute()){
			print_r($requeteConnexion->errorInfo());
				
		}
			
	$test = $requeteConnexion->fetch();
	if(count($test) == 1){
		echo "<h1>PAS OK</h1>";
	}else echo "<h1>OK</h1>";
?>