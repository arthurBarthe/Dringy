<?php
//Paramètres de connexion sql
include("sqlConnectionParams.php");
?>


<!DOCTYPE html>
<html>
<head>

	<title>Accueil Dringy</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Include Leaflet CSS file. -->
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
	<link rel="stylesheet" href="Map.css" />
	
</head>

<body>
	<!-- Include Leaflet JavaScript file.  -->
	<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
	
	<!--Ajout du script qui gère la partie AJAX utilisée pour l'enregistrement d'une anomalie sans rechargement de la page -->
	<script src="oXHR.js"></script>
	<script src="ajax.js"></script>

	<!-- Artur code -->
	<form method="POST" ACTION="enregistrement.php">
	<input type="text" name="nom" id="nom"/>
	<input type="text" name="categorie" id="categorie"/>
	
	<!-- @Arthur : j'ai changé le type de tes input de "hidden" à "text" pour visualiser plus facilement le résultat -->
	<!-- @Arthur : j'ai rajouté des attributs "id" car je n'arrivais pas à utiliser le DOM pour récupérer ces deux inputs dans le code javascript.
	
	Il existe normalement une méthode getElementsByName() mais ça ne marchait pas, j'ai donc utilisé getElementById() qui fonctionne bien -->    
	<input type="hidden" name="lat" id="lat"/>
	<input type="hidden" name="long" id="long"/>
	<input type="button" onclick="request(readData); marker.dragging.disable();" value="Valider anomalie" />
	</form>
	
	<!-- Map is here  -->
	<button id="ajoutAnomalie">Ajouter une anomalie</button>
	<div id="map"></div>
	
	<script src="Map.js"></script>
	<?php
	//Cette partie va chercher en bdd les anomalies et appelle une fonction javascript qui ajoute un marker à la bonne position
	try{
		//Connexion à la base de donnée locale. Ici il faut spécifier que le port est 5434, j'avais configuré postgresql ainsi
		$bdd = pg_connect("host=$host dbname=$dbname port=$port user=$username password=$password");
		
		//Parcours de la liste des anomalies
		$reponse = pg_query('SELECT "nom", "idCategorie", "latitude" as lat, "longitude" as long FROM "D_anomalies"');
		echo '<script>';
		while($donnee_anomalie = pg_fetch_array($reponse, null, PGSQL_ASSOC)){
			//Définition du contenu du popup en fonction des détails de l'anomalie
			$details = '<table><tr><td>Nom</td><td>' . $donnee_anomalie['nom'] . '</td></tr>';
			$details = $details . '<tr><td>Categorie</td><td>' . $donnee_anomalie['idCategorie'] . '</td></tr></table>';
			
			echo 'addMarker(L.latLng(' . $donnee_anomalie['lat'] . ',' . $donnee_anomalie['long'] . '), "' . $details . '");';
		}
		pg_free_result($reponse);
		echo '</script>';
		pg_close($bdd);
	}
	catch(Exception $e){		
		echo('Erreur : ' . $e->getMessage());
	}
	?>

</body>
</html>
