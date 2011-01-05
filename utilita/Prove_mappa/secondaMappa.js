var PuntaIndirizzi = function() {
	//Creazione wrapper mappa
	var mapdiv = document.createElement('div');
	mapdiv.setAttribute("id", "map");
	document.body.appendChild(mapdiv);

	//Imposta origine del percorso
	var origine = new google.maps.LatLng(40.863, 14.2767);
	//Imposta destinazione del percorso
	var destinazione = new google.maps.LatLng(40.600, 14.3500);
	//Imposta punti intermedi del percorso
	var puntiIntermedi = [    
	{
		location : new google.maps.LatLng(40.853, 14.2900)
	},

	{
		location : new google.maps.LatLng(40.879, 14.2750)
	},

	{
		location : new google.maps.LatLng(45.750, 14.5000)
	}
	];


	/* directionDisplay mostra a video l'itinerario recuperato come
     * DirectionResult da un DirectionService
     */
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var options = {
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById('map'), options);


	var directionsService = new google.maps.DirectionsService();
	var request = {
		origin:origine,
		destination:destinazione,
		waypoints: puntiIntermedi,
		optimizeWaypoints: true,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	};
	directionsService.route(request,function(response, status) {
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setMap(map);
			directionsDisplay.setDirections(response);
		}
	});
};