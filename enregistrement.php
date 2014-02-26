<?php
//Paramètres de connexion sql
include("sqlConnectionParams.php");

//Récupération des variables envoyées par la méthode POST
$nom = (isset($_POST['nom']))? $_POST['nom'] : NULL;
$categorie = (isset($_POST['categorie']))? $_POST['categorie'] : NULL;
$lat = (isset($_POST['lat']))? $_POST['lat'] : NULL;
$lon = (isset($_POST['long']))? $_POST['long'] : NULL;

if($nom && $categorie && $lat && $lon){
	try{
		//Connexion à la base de donnée locale. Ici il faut spécifier que le port est 5434, j'avais configuré postgresql ainsi
		$bdd = pg_connect("host=$host dbname=$dbname port=$port user=$username password=$password");
		
		//Insertion dans la base de données de la nouvelle anomalie
		$req = pg_prepare($bdd, "insertionAnomalie", 'INSERT INTO "D_anomalies"("nom", "idCategorie", "latitude", "longitude") VALUES($1, $2, $3, $4)');
		pg_execute($bdd, "insertionAnomalie", array($nom,$categorie,$lat,$lon));
		echo 'OK';
	}
	catch(Exception $e){		
		echo('Erreur : ' . $e->getMessage());
	}
}
else{
	echo 'Erreur: toutes les données nécessaires à l\'enregistrement d\'une anomalie n\'ont pas été fournies';
}


?>