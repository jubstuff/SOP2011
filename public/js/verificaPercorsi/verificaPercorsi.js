$(document).ready(function(){
	var mapAssegnatiDiv = document.getElementById('map-assegnati');
	var mapEffettuatiDiv = document.getElementById('map-effettuati');
	//bisogna creare due DirectionsRenderer per 'pilotare' due mappe
	var directionsDisplayA = new google.maps.DirectionsRenderer();
	var directionsDisplayE = new google.maps.DirectionsRenderer();
	
	var directionsService = new google.maps.DirectionsService();
	var mapAssegnati = initialize(mapAssegnatiDiv);
	var mapEffettuati = initialize(mapEffettuatiDiv);
	
	directionsDisplayA.setMap(mapAssegnati);
	directionsDisplayE.setMap(mapEffettuati);


	$("#elencoPercorsi > li > a").click(effettuaRichiesta);

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

	function effettuaRichiesta(event){
		//impedisce al link di essere attivato normalmente
		event.preventDefault();
		//recupera il codice del percorso
		var attributoHref = $(this).attr('href');
		var richiesta = [];
		var temp = attributoHref.split('&');
		for(var i=0; i<temp.length; i++){
			var temp2 = temp[i].split('=');
			var chiave = temp2[0];
			var valore = temp2[1];
			richiesta[chiave] = valore;
		}

		$.getJSON('../../../lib/percorso.json.php', {
			'codicePercorso':richiesta['codicePercorso']
		}, function(rispostaJSON){
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
					directionsDisplayA.setDirections(response);
				}
			});

		});
		//@todo spostare il file a cui si fa la richiesta?
		/**
		 * Recupera il percorso dal file XML del dispositivo relativo al
		 * turno assegnato
		 */
		$.getJSON('percorsoDaXML.json.php', {
			'codicePercorso':1,
			'codiceTurno':richiesta['codiceTurno']
		}, function(rispostaJSON){
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
					directionsDisplayE.setDirections(response);
				}
			});
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
