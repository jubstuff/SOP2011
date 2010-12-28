/**
 * Crea il div che conterrà la mappa
 */
function creaDivMappa() {
	//creo il div che conterrà la mappa
	var mapdiv = document.createElement('div');
	mapdiv.setAttribute("id", "map");
	document.body.appendChild(mapdiv);
	return mapdiv;
}
/**
 * Inizializza una mappa centrata su napoli
 */
function initialize(mapDiv) {
	var latlng = new google.maps.LatLng(40.847736,14.2519);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	return new google.maps.Map(mapDiv,
		myOptions);
}





$(document).ready(function(){
	//var mapDiv = creaDivMappa();	
	var mapDiv = document.getElementById('map');
	var map = initialize(mapDiv);
	var count=1;
	var storico = [];	
	var percorso = [];
	var directionsDisplay = new google.maps.DirectionsRenderer();	
	var directionsService = new google.maps.DirectionsService();
	var request = {};
	var latlng;
	
	function creaMarker(optionSelected, latlng){
		return new google.maps.Marker({
			position: new google.maps.LatLng(latlng[0], latlng[1]), 
			map: map, 
			title:optionSelected.text(),
			animation: google.maps.Animation.DROP,
			icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/marker'+count+'.png'
		});
	}
	
	
	
	
	
	$("#error").ajaxError(function(event, request, settings){
		$(this).append("<li>Error requesting page " + settings.url + "</li>");
	});

	$("#percorso > li").live('click',function(){
		alert("cliccato su un elemento del percorso");
	});
	
	
	$('#salvaPercorso').click(function(){
		console.log(percorso);
		$.post('salva.php', {p:percorso}, function(){
			$("#info").text("Percorso salvato correttamente");
			
		});
	});


	$("#luoghi").change(function(e){
		var selected = $('#luoghi option:selected');
		var textCurrent = selected.text();
		var valueCurrent = selected.val();
		
		latlng = $('#luoghi option:selected').val().split(',');
		latlng[0] = Number(latlng[0]);
		latlng[1] = Number(latlng[1]);
		
		storico.push(new google.maps.LatLng(latlng[0], latlng[1]));
		percorso.push({indirizzo:textCurrent,lat:latlng[0],lng:latlng[1]});
		
		//		var markerOpt = {
		//			position: new google.maps.LatLng(latlng[0], latlng[1]), 
		//			map: map, 
		//			title:selected.text(),
		//			animation: google.maps.Animation.DROP,
		//			icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/marker'+count+'.png'
		//		};
		//		var marker = new google.maps.Marker(markerOpt);
		
		var marker = creaMarker(selected, latlng);
		
		
		console.info("Testo selected");
		console.log(textCurrent);
		console.info("Valore selected");
		console.log(valueCurrent);
		
		//visualizzo la tabella con il percorso
		var row = $("<tr>").appendTo("#percorso tbody");
		$("<td>").text(textCurrent).appendTo(row);
		
		
		
		
		if(count<=2){
			//ci sono solo origine e destinazione
			request = {
				origin: storico[0],
				destination: storico[storico.length-1],
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
		} else if(count>2) {
			//esiste almeno un punto intermedio
			var l = storico.length;
			var wps = [];
			for(var i=1; i<l-1; i++){
				//array di Waypoints 
				//http://code.google.com/apis/maps/documentation/javascript/reference.html#DirectionsWaypoint
				wps.push({
					location: storico[i]
				});
			}
			
			console.info("I punti intermedi");
			console.log(wps);
			
			request = {
				origin: storico[0],
				destination: storico[storico.length-1],
				waypoints: wps,
				travelMode: google.maps.DirectionsTravelMode.DRIVING
			};
		}
		count++;

		directionsService.route(request,function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setOptions({
					//elimino i marker perché ho inserito quelli numerati
					suppressMarkers: true
				});
				directionsDisplay.setMap(map);
				directionsDisplay.setDirections(response);
			}
		});
		
		selected.remove();
		
		console.info("Lo storico fino ad ora");
		console.log(storico);
	});
})