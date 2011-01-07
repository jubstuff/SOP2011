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
    var pDCInfo;
	
    $("#info").hide().text("Percorso salvato correttamente");
	
	
    function creaMarker(optionSelected, lat, lng){
        return new google.maps.Marker({
            position: new google.maps.LatLng(lat, lng),
            map: map,
            title:optionSelected.text(),
            animation: google.maps.Animation.DROP,
            icon: 'http://gmaps-samples.googlecode.com/svn/trunk/markers/green/marker'+count+'.png'
        });
    }
	
    //@todo aggiungere rimozione degli elementi di un percorso
    $("#percorso > li").live('click',function(){
        alert("cliccato su un elemento del percorso");
    });
    
    /* richiesta AJAX */
    function onSuccess(json) {
        var response = parseInt(json.response,10);
        if(isNaN(response)) {
            alert("Creazione fallita!");
            alert(json.query);
        } else if(response==1) {
            $("#info").show().fadeOut(1500);
            setTimeout(function(){window.location='index.php'}, 1500);
        }
    }
    $('#salvaPercorso').submit(function(event){
        //console.log(percorso);
        event.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type : 'POST',
            success : onSuccess,
            data : {
                p:percorso
            },
            dataType : 'json'
        });
    });
    /* FINE richiesta AJAX */

    $("#luoghi").change(function(event){
        var selected = $('#luoghi option:selected');
        var textCurrent = selected.text();
        var valueCurrent = selected.val();
		
        pDCInfo = valueCurrent.split(',');
        var lat = Number(pDCInfo[0]);
        var lng = Number(pDCInfo[1]);
		
        var pDC = {
            'codicePC' : Number(pDCInfo[2])
        };
        console.log(pDC);
        storico.push(new google.maps.LatLng(lat, lng));
        percorso.push(pDC);
		
        var marker = creaMarker(selected, lat, lng);
		
        //		console.info("Testo selected");
        //		console.log(textCurrent);
        //		console.info("Valore selected");
        //		console.log(valueCurrent);
		
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
			
            //			console.info("I punti intermedi");
            //			console.log(wps);
			
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
		
    //		console.info("Lo storico fino ad ora");
    //		console.log(storico);
    });
})
