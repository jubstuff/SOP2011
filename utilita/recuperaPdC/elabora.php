<?php
require_once 'DB.php';
$indirizzo = $_POST['indirizzo'];

$indirizzoEnc = urlencode($indirizzo);
$url = "http://maps.googleapis.com/maps/api/geocode/xml?address=$indirizzoEnc&sensor=false";
//echo $url;
$db = DB::getInstance();
$indirizzo = $db->escape($indirizzo);
$xml = simplexml_load_file($url) or die("url not loading"); 
$latitudine = $xml->result->geometry->location->lat;
$longitudine = $xml->result->geometry->location->lng;
$str = "INSERT INTO PuntiDiControllo(indirizzo, latitudine, longitudine, idTag, codiceCliente) VALUES('%s', %f, %f, %d, %d)\n";
$str = sprintf($str, $indirizzo, $latitudine, $longitudine, 1, 1);
$fp = fopen ("PuntiDiControllo.sql", "a+");
fwrite ($fp, $str);
header("Location: provalatlong.php");
?>