<?php
require_once 'config.php';
require_once 'DB.php';

/* recupero i posti dal database */
$db = DB::getInstance();
$queryStr = "SELECT indirizzo,latitudine,longitudine FROM PuntiDiControllo";
$result  = $db->query($queryStr);


header("Content-type: application/json");

/* creo il documento XML e il nodo radice */
$pdc = array();


/* stampo gli elementi per ogni posto nel database */
while($row = $result->fetch_assoc()) {
	$pdc[] = $row;
}

/* stampo il risultato */
echo json_encode($pdc);

?>