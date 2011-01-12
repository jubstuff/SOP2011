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

//var_dump($infoAssoc);

//var_dump($doc_kml);
//header("Content-type: application/json");
//echo '<p>Informazioni recuperate dal kml</p>';
//for ($i = 0; $kml->document->data[$i]->percorso != ''; $i++) {
//  $infoAssoc['percorso'][$i] = $kml->document->data[$i]->percorso;
//  $infoAssoc['indirizzo'][$i] = $kml->document->data[$i]->indirizzo;
//  $infoAssoc['latitudine'][$i] = $kml->document->data[$i]->latitudine;
//  $infoAssoc['longitudine'][$i] = $kml->document->data[$i]->longitudine;
//
//}
//foreach ($kml->document->data as $d) {
////	var_dump($d);
//	$codP = (string)$d->percorso;
//	$infoAssoc[$codP]['pdc'][] = array('indirizzo' => (string)$d->indirizzo, 'latitudine' => (float)$d->latitudine, 'longitudine' => (float)$d->longitudine);
//}
//print_r($infoAssoc);
//$lunghezza = count($infoAssoc['percorso']);
//echo 'lunghezza: ' . $lunghezza . '<br /><br />';
/*
  for ($i = 0; $i < $lunghezza; $i++) {
  echo $infoAssoc['percorso'][$i] . '<br />';
  echo $infoAssoc['indirizzo'][$i] . '<br />';
  echo $infoAssoc['latitudine'][$i] . '<br />';
  echo $infoAssoc['longitudine'][$i] . '<br /><br />';

  }
 */
//echo json_encode($infoAssoc);
//
//
//
//
//$arrayDiProva = array(
//	array('percorso' => 1, 'pdc' => array(
//		array('indirizzo' => 'via umbria napoli', 'latitudine' => 40.89354, 'longitudine' => 14.258068),
//		array('indirizzo' => 'via toledo napoli', 'latitudine' => 40.845509, 'longitudine' => 14.249201),
//	))
//);
//echo '<p>',json_encode($arrayDiProva),'</p>';
?>