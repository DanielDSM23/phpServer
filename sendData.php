<?php
$IP = $_SERVER['REMOTE_ADDR'];

$mysqli = new mysqli("localhost/","daniel.monteiro1","xxxx","listeClient");

if($mysqli -> connect_errno){
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	exit();
}
$query = "SELECT clientID FROM listeClient WHERE listeClient.IP = '".$IP."'";
$result = $mysqli -> query($query);
$row = null;
while ($row = $result->fetch_assoc()) {
	$clientID = $row;
}
unset($mysqli);

if(isset($clientID)){
	$bddChute = new mysqli("localhost","daniel.monteiro1","xxxx","dateChute");
	if($bddChute -> connect_errno){
		echo "Failed to connect to MySQL: " . $bddChute -> connect_error;
		exit();
	}
	$raison = $_GET['raison'];
	date_default_timezone_set('Europe/Paris');
	$dateHeure = date("d/m/Y H:i:s");
	$query = "INSERT INTO dateChute (dateHeure, raison) VALUES ('$dateHeure', '$raison')";
	$result = $bddChute -> query($query);
	echo "Données enregistrées !";
}
else{
	echo "access forbidden!";
}

?>
