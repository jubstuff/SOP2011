$.getJSON('percorso.json.php', { //@todo utilizzare la funzione $.ajax
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