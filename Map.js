//add CloudMade tile layer to our map + the attribution text + maximum zoom level of the layer

var map = L.map('map').setView([47.2117, -1.5550], 13);
		
L.tileLayer('http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
}).addTo(map);

// on instancie un marker centré sur la vue actuelle de la carte
var marker = L.marker(map.getCenter(), {draggable :'true'});

// on crée une variable varG qui sera incrémentée lorsque'on cliquera sur le bouton "Ajouter une anomalie"
var varG = 0;

// on récupère le bouton "Ajouter une anomalie"
var ajoutAnomalie = document.getElementById('ajoutAnomalie');

// on utilise l'évènement "click" sur le bouton "Ajouter une anomalie"

ajoutAnomalie.addEventListener('click', 
	function affiche(e){
		if (map.getZoom() > 13) {
			alert('Positionnez votre anomalie et validez');
			//var popup = L.popup().setContent('Veuillez positioner l\'anomalie sur la carte s\'il-vous-plaît');
			//popup.addTo(map);
			ajoutAnomalie.innerHTML = 'Validez (pas envore fonctionnel)';
			//si zoom suffisant,création marqueur
			marker.setLatLng(map.getCenter());
			marker.addTo(map);
		}
		else {
			alert('zoomez d\'avantage');
		}
				
	});
	
function addMarker(pos, name){
	var a = L.marker(pos).bindPopup(name);
	a.addTo(map);
}

// pour récupérer la lat et la long dans les input
marker.on('dragstart',
		function getLatLng(e){
			document.getElementById('lat').value = marker.getLatLng().lat;
			document.getElementById('long').value = marker.getLatLng().lng;
		});

marker.on('dragend',
		function getLatLng(e){
			document.getElementById('lat').value = marker.getLatLng().lat;
			document.getElementById('long').value = marker.getLatLng().lng;
		});


