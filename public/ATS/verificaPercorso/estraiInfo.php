<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
$pageTitle = "Estrai indirizzi";
$tuttiISorveglianti = Sorvegliante::findAll();
?>

<?php include HELPERS_DIR . '/testata.php'; ?>

<?php

//include 'percorsiKMLfile.php';

$kml = simplexml_load_file('percorsiKMLfile.php');
$info = $kml->document;
//var_dump($doc_kml);

$strInizio = '[';
$strFine = ']';
$strJSON .= $strInizio;

for($i = 0; $info->data[$i]->percorso != '' ; $i++) {
    $a = $info->data[$i]->percorso;
    echo $a . " | ";
    $b = $info->data[$i]->pdc;
    echo $b . " | ";
    $c = $info->data[$i]->indirizzo;
    echo $c . " | ";
    $d = $info->data[$i]->latitudine;
    echo $d . " | ";
    $e = $info->data[$i]->longitudine;
    echo $e . "<br />";

    // genero il file JSON
    $strJSON .= '{"indirizzoP' .$a . '":"' . $c . '","latitudine":"' . $d . '","longitudine":"' . $e . '"},';
}

//$strJSON .= $strFine;

$fp = fopen("indirizzi.json", "w+");
fwrite($fp, $strJSON);
fseek($fp, -1, SEEK_END);
fwrite($fp, $strFine);
fclose($fp);

?>