
//add CloudMade tile layer to our map + the attribution text + maximum zoom level of the layer

var map = L.map('map').setView([47.2117, -1.5550], 13);
		
L.tileLayer('http://{s}.tile.cloudmade.com/BC9A493B41014CAABB98F0471D759707/997/256/{z}/{x}/{y}.png', {
			maxZoom: 18,
			attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>'
}).addTo(map);


//add a marker to our map		
var marker = L.marker([47.2117, -1.5550], {draggable :'true'}).addTo(map);

//add a popup not opened by default
		//marker.bindPopup("<b>Anomalie</b>");

		/*
		var element = document.getElementById('map');		
		
		element.on('click', function (e) {
				    marker = new L.marker(e.latlng, {id:uni, icon:redIcon, draggable:'true'});
				    marker.on('dragend', function(event){
				            var marker = event.target;
				            var position = marker.getLatLng();
				            alert(position);
				            marker.setLatLng([position],{id:uni,draggable:'true'}).bindPopup(position).update();
				    });
				    map.addLayer(marker);
				};		
