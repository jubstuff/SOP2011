<?php
require_once 'config.php';
require_once 'DB.php';

/* recupero i posti dal database */
$db = DB::getInstance();
$queryStr = "SELECT indirizzo,latitudine,longitudine FROM PuntiDiControllo";
$result  = $db->query($queryStr);


header("Content-type: text/xml");

/* creo il documento XML e il nodo radice */
$dom = new DOMDocument('1.0');
$node = $dom->createElement('markers');
$parentNode = $dom->appendChild($node);

/* stampo gli elementi per ogni posto nel database */
while($row = $result->fetch_assoc()) {
	$node = $dom->createElement('marker');
	$newnode = $parentNode->appendChild($node);
	$newnode->setAttribute("name", $row['indirizzo']);
	$newnode->setAttribute("address", $row['indirizzo']);
	$newnode->setAttribute("lat", $row['latitudine']);
	$newnode->setAttribute("lng", $row['longitudine']);
}

/* stampo il risultato */
echo $dom->saveXML();

?>
