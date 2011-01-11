$(document).ready(function(){
if(typeof datepicker === 'function'){

	$("#data").datepicker({
		dateFormat: 'yy-mm-dd'
	});
}

	var mapDiv = document.getElementById('map');
	var panelDiv = document.getElementById('panel');
	var map = initialize(mapDiv);
	var directionsDisplay = new google.maps.DirectionsRenderer();
	var directionsService = new google.maps.DirectionsService();

	$("#percorsiWrapper p").hover(effettuaRichiesta,
	function(){
		$(this).css('background-color','#FFF');
	});

	/**
     * Inizializza una mappa centrata su Napoli
	 */
	function initialize(mapDiv) {
		var napoli = new google.maps.LatLng(40.847736,14.2519);
		var myOptions = {
			zoom: 10,
			center: napoli,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		return new google.maps.Map(mapDiv, myOptions);
	}

	function effettuaRichiesta(){
		//recupera il codice del percorso
		$(this).css('background-color','#FFFF66');
		var codicePercorso = $(this).children(".checkboxPercorso").first().val();
		$.getJSON('percorso.json.php', {
			'codicePercorso':codicePercorso
		}, recuperaPercorso);
		return false;
	}
	/**
	 * recuperaPercorso
	 *
	 * Costruisce il percorso a partire dall'oggetto JSON restituito dal DB
	 */
	function recuperaPercorso(rispostaJSON){
		var puntiIntermedi = creaPuntiIntermedi(rispostaJSON);

		//recupera il primo (origine) e l'ultimo elemento (destinazione)
		var origine = puntiIntermedi.shift();
		var destinazione = puntiIntermedi.pop();
		var request = {};

		if(puntiIntermedi.length<1) {
			//ci sono solo partenza e arrivo
			request = {
				origin: origine.location,
				destination: destinazione.location,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
		} else {
			//esiste almento un punto intermedio
			request = {
				origin: origine.location,
				destination: destinazione.location,
				waypoints: puntiIntermedi,
				optimizeWaypoints:false,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
		}

		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setMap(map);
				directionsDisplay.setPanel(panelDiv);
				directionsDisplay.setDirections(response);
			}
		});
	}

	/**
	 * creaPuntiIntermedi
	 *
	 * Crea l'array di Waypoints che caratterizzano il percorso
	 */
	function creaPuntiIntermedi(puntiGeografici) {
		var puntiIntermedi = [];
		for(var i=0; i < puntiGeografici.length; i++){
			puntiIntermedi.push({
				location : new google.maps.LatLng(
					puntiGeografici[i].latitudine,
					puntiGeografici[i].longitudine)
			});
		}
		return puntiIntermedi;
	}
});
