<?php require_once 'config.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">
   <head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Prova recupera JSON</title>
		<link rel="stylesheet" type="text/css" href="<?php echo PUBLIC_URL . '/css/screen.css'; ?>"/>
		<script type="text/javascript" src="../../lib/jQuery/jquery-1.4.4.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript">
			//<![CDATA[
			
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
			
			function creaDivMappa() {
				//creo il div che conterrà la mappa
				var mapdiv = document.createElement('div');
				mapdiv.setAttribute("id", "map");
				document.body.appendChild(mapdiv);
				return mapdiv;
			}
			
			jQuery(document).ready(function(){
				$.getJSON('json.php',function(markers){
					var puntiIntermedi = creaPuntiIntermedi(markers);
					
//					puntiIntermedi.shift();
//					var partenza = puntiIntermedi.shift();
//					var arrivo = puntiIntermedi.pop();

					var mapdiv = creaDivMappa();
					
					
					var directionsDisplay = new google.maps.DirectionsRenderer();
					var options = {
						mapTypeId: google.maps.MapTypeId.ROADMAP
					};
					var map = new google.maps.Map(document.getElementById('map'), options);
					
					var directionsService = new google.maps.DirectionsService();
					var request = {
						origin: markers[1].indirizzo,
						destination: markers[markers.length-1].indirizzo,
						waypoints: puntiIntermedi,
						optimizeWaypoints:true,
						travelMode: google.maps.DirectionsTravelMode.DRIVING
					};
					directionsService.route(request,function(response, status) {
						if (status == google.maps.DirectionsStatus.OK) {
							directionsDisplay.setMap(map);
							directionsDisplay.setDirections(response);
						}
					});
					
				});
			});
			//]]>
		</script>
   </head>
	<body>
		
	</body>
</html>