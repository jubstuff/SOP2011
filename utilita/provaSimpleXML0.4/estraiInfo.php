<?php

require_once 'config.php';

$pageTitle = "Estrai indirizzi";
?>

<?php

//include 'percorsiKMLfile.php';
$kml = simplexml_load_file('percorsiKMLfile.php');

$info = $kml->document;

/* Recupero dati KML */
$infoAssoc = array();
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

foreach ($kml->document->data as $d) {
//	var_dump($d);
	$codP = (int)$d->percorso;
	$infoAssoc[$codP]['pdc'][] = array('indirizzo' => (string)$d->indirizzo, 'latitudine' => (float)$d->latitudine, 'longitudine' => (float)$d->longitudine);
}

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
echo json_encode($infoAssoc);
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