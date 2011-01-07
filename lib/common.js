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