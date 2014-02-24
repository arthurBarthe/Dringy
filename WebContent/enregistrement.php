<?php
//Paramètres de connexion à la base de donnée
$dbname='postgis20';
$host='127.0.0.1';
$username='postgres';
$password='86142531A';

//Récupération des variables envoyées par la méthode POST
$nom = (isset($_POST['nom']))? $_POST['nom'] : NULL;
$categorie = (isset($_POST['categorie']))? $_POST['categorie'] : NULL;
$lat = (isset($_POST['lat']))? $_POST['lat'] : NULL;
$lon = (isset($_POST['long']))? $_POST['long'] : NULL;

if($nom && $categorie && $lat && $lon){
	try{
		//Connexion à la base de donnée locale. Ici il faut spécifier que le port est 5434, j'avais configuré postgresql ainsi
		$bdd = new PDO("pgsql:dbname=$dbname;host=$host;port=5434", $username, $password );
		
		//Insertion dans la base de données de la nouvelle anomalie
		$req = $bdd->prepare('INSERT INTO "Dringy_anomalies"("nom", "categorie", "position") VALUES(:nom, :categorie, :position)');
		$req->execute(array(
		'nom' => $nom,
		'categorie' => $categorie,
		'position' => 'POINT(' . $lat . ' ' . $lon . ')'
		));
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