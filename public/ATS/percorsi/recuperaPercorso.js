function creaPuntiIntermedi(puntiJson) {
	var puntiIntermedi = [];
	for(var i=0; i < puntiJson.length; i++){
		puntiIntermedi.push({
			location : new google.maps.LatLng(
				puntiJson[i].latitudine,
				puntiJson[i].longitudine)
		});
	}
	return puntiIntermedi;
}

$(document).ready(function(){
	var mapDiv = document.getElementById('map');
	var map = initialize(mapDiv);
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();

	$("#elencoPercorsi > li > a").click(function(event){
		event.preventDefault();
		var codicePercorso = $(this).attr('href');
		$.getJSON('percorso.json.php', {
			'codicePercorso':codicePercorso
		},function(markers){
			var puntiIntermedi = creaPuntiIntermedi(markers);
			var origine = puntiIntermedi.shift();
			var destinazione = puntiIntermedi.pop();
			var request = {};
			if(puntiIntermedi.length<1) {
				request = {
					origin: origine.location,
					destination: destinazione.location,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
			} else {
				request = {
					origin: origine.location,
					destination: destinazione.location,
					waypoints: puntiIntermedi,
					optimizeWaypoints:true,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				
			}
			directionsService.route(request, function(response, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setMap(map);
					directionsDisplay.setDirections(response);
				}
			});
		});
	});
});