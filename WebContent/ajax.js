function request(callback) {
	var xhr = getXMLHttpRequest();
	var nom = encodeURIComponent(document.getElementById("nom").value);
	var categorie = encodeURIComponent(document.getElementById("categorie").value);
	var lat = encodeURIComponent(document.getElementById("lat").value);
	var lon = encodeURIComponent(document.getElementById("long").value);
	
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			callback(xhr.responseText);
		}
	};
	
	xhr.open("POST", "enregistrement.php", true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send("nom="+nom+"&categorie="+categorie+"&lat="+lat+"&long="+lon);
}

function readData(sData) {
	// On peut maintenant traiter les données sans encombrer l'objet XHR.
	if (sData == "OK") {
		alert("Merci, votre signalement a bien été pris en compte!");
	} else {
		alert("Il y a eu un problème, veuillez réessayer svp.");
	}
}

request(readData);