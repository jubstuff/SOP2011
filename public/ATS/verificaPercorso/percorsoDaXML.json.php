<?php
require_once 'config.php';
//@todo validare la richiesta GET
$codicePercorso = $_GET['codicePercorso'];
$codiceTurno = $_GET['codiceTurno'];

//@todo cambiare path del file con quello generale
$xmlPath = ROOT_DIR . '/archivio/' . 'turno' . $codiceTurno .'.xml';
$turno = simplexml_load_file($xmlPath);
$codiceTurno = $turno['id'];

/* Recupero dati XML */
$response = array();

foreach ($turno as $percorso) {
	$percorsoID = (int) $percorso['id'];
	if ($codicePercorso == $percorsoID) {
		foreach ($percorso as $pdc) {
			$indirizzo = (string) $pdc->indirizzo;
			$latitudine = (float) $pdc->latitudine;
			$longitudine = (float) $pdc->longitudine;

			$punto = array('indirizzo' => $indirizzo,
				'latitudine' => $latitudine,
				'longitudine' => $longitudine
			);
			$response[] = $punto;
		}
		break;
	}
}
header("Content-type: application/json");
echo json_encode($response);
?>