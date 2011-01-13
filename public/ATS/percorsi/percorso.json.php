<?php
require_once 'config.php';
require_once 'DB.php';

//@todo validare richiesta get
$codicePercorso = $_GET['codicePercorso'];
$db = DB::getInstance();

$queryStr = "select P.codicePercorso,PP.codicePC,Pdc.latitudine,Pdc.longitudine ";
$queryStr .= "from (Percorsi P JOIN PERCORSO_PDC PP ON P.codicePercorso=PP.codicePercorso) JOIN PuntiDiControllo Pdc ON PP.codicePC=Pdc.codicePC ";
$queryStr .= "WHERE P.codicePercorso=$codicePercorso ";
$queryStr .= "ORDER BY PP.codicePC";

$percorso = array();
$result = $db->query($queryStr);
//@todo validare query
while($row = $result->fetch_assoc()) {
	$percorso[] = $row;
}

header("Content-type: application/json");

/* stampo il risultato */
echo json_encode($percorso);

?>
