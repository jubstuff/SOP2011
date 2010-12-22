<!DOCTYPE html>
<html>
    <head>
        <title>Prima Mappa - 22.12.2010</title>
        <style type="text/css">
            #map {
                height: 600px;
                width: 800px;
}
        </style>
        <script type="text/javascript"
                src="http://maps.google.com/maps/api/js?sensor=false&language=it">
        </script>

        <script type="text/javascript">
            var punti = ["via toledo, napoli", "piazza cavour, napoli", "piazza municipio, napoli"];
            
//            Array che serve per la funzione addMarker
//            var markers=[];
//            Inizializzazione funzionante
//
//              var initialize = function() {
//                var latlng = new google.maps.LatLng(40.863, 14.2767);
//
//                // imposta le opzioni di visualizzazione
//                var options = {
//                    zoom: 12,
//                    center: latlng,
//                    mapTypeId: google.maps.MapTypeId.ROADMAP
//                };
//
//                // crea l'oggetto mappa
//                var map= new google.maps.Map(document.getElementById('map'), options);
//            }


            //JUST: Viene ricreata ogni volta
            //Come è fatto adesso, costruisce 3 mappe diverse e segna su ognuna un indirizzo
            var PuntaIndirizzi = function() {
                //In questo esmpio la mappa è centrata sulle coordinate di Napoli
                //Dobbiamo sostituirle con quelle del primo punto di controllo
                var latlng = new google.maps.LatLng(40.863, 14.2767);
                var options = {
  				zoom: 12,
  				center: latlng,
  				mapTypeId: google.maps.MapTypeId.ROADMAP
                            };
                var map = new google.maps.Map(document.getElementById('map'), options);

                var geocoder = new google.maps.Geocoder();

                for(var i=0;i<=punti.length;i++) {
                    geocoder.geocode( {'address': punti[i]}, function(results,status) {

                        if (status == google.maps.GeocoderStatus.OK) {
                         
                            var marker = new google.maps.Marker(
				{
  				position: results[0].geometry.location,
  				map: map,
                                draggable: true
				}
                            );
			}});
                }
            };

            // crea il marcatore
            //JUST: Funzione come in C
            function addMarker (coordinate) {
               markers.push(new google.maps.Marker( {
                   map: map,
                   position: coordinate,
                   draggable: true } )
               )
            }
        </script>
    </head>
    <body onload="PuntaIndirizzi()">
        <div id="map"></div>
    </body>
</html>