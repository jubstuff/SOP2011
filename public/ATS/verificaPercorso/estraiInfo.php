<?php
require_once 'config.php';
require_once 'Redirect.php';
?>

<?php

//include 'percorsiKMLfile.php';
//$kml = simplexml_load_file('percorsiKMLfile.php');
$turno = simplexml_load_file('turno.xml');



/* Recupero dati KML */
$infoAssoc = array();
$count = 0;

foreach ($turno as $percorso) {
	$percorsoID = (int) $percorso['id'];
	$infoAssoc[$count]['percorso'] = $percorsoID;
	$infoAssoc[$count]['pdc'] = array();

	foreach ($percorso as $pdc) {
		$indirizzo = (string) $pdc->indirizzo;
		$latitudine = (float) $pdc->latitudine;
		$longitudine = (float) $pdc->longitudine;

		$punto = array('indirizzo' => $indirizzo,
			'latitudine' => $latitudine,
			'longitudine' => $longitudine
		);
		$infoAssoc[$count]['pdc'][] = $punto;
	}
//	echo '<p>Punti di controllo del percorso ' . $percorsoID . '</p>';
//	var_dump($infoAssoc[$count]['pdc']);
	$count++;
}


$filename = 'turno' . $turno['id'] . '.json';
$fp = fopen($filename, 'w');
fwrite($fp, json_encode($infoAssoc));
fclose($fp);
$r = new Redirect(PUBLIC_URL . '/ATS');
$r->doRedirect();