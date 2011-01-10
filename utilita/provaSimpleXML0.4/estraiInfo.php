<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
$pageTitle = "Estrai indirizzi";
$tuttiISorveglianti = Sorvegliante::findAll();
?>

<?php

//include 'percorsiKMLfile.php';
$kml = simplexml_load_file('percorsiKMLfile.php');

$info = $kml->document;
//var_dump($doc_kml);

//header("Content-type: application/json");

/* Recupero dati KML */
$infoAssoc = Array();

//echo '<p>Informazioni recuperate dal kml</p>';
for ($i = 0; $kml->document->data[$i]->percorso != ''; $i++) {
  $infoAssoc['percorso'][$i] = $kml->document->data[$i]->percorso;
  $infoAssoc['indirizzo'][$i] = $kml->document->data[$i]->indirizzo;
  $infoAssoc['latitudine'][$i] = $kml->document->data[$i]->latitudine;
  $infoAssoc['longitudine'][$i] = $kml->document->data[$i]->longitudine;
  
}

$lunghezza = count($infoAssoc['percorso']);
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

?>