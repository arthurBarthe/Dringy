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

	<!-- Artur code -->
	<form method="POST" ACTION="enregistrement.php">
	<input type="text" name="nom" />
	<input type="text" name="categorie" />
	
	<!-- @Arthur : j'ai changé le type de tes input de "hidden" à "text" pour visualiser plus facilement le résultat -->
	<!-- @Arthur : j'ai rajouté des attributs "id" car je n'arrivais pas à utiliser le DOM pour récupérer ces deux inputs dans le code javascript.
	
	Il existe normalement une méthode getElementsByName() mais ça ne marchait pas, j'ai donc utilisé getElementById() qui fonctionne bien -->    
	<input type="text" name="lat" id="lat"/>
	<input type="text" name="long" id="long"/>
	<input type="submit" value="Valider anomalie" />
	</form>

	<!-- Include Leaflet JavaScript file.  -->
	<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>
	
	<!-- Map is here  -->
	<button id="ajoutAnomalie">Ajouter une anomalie</button>
	<div id="map"></div>
	
	<script src="Map.js"></script>

</body>
</html>
