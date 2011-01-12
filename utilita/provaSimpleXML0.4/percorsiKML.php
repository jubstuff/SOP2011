<?php

/* Connessione al database */

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = 'q1p0w2o9';
$dbName = 'PercorsiKML2011';

// credenziali di accesso
$connection = @mysql_connect($dbHost, $dbUser, $dbPassword);

if (!$connection) {
    die('Not connected: ' . mysql_error());
}

// seleziono il database
$dbSelected = mysql_select_db($dbName);

if (!$dbSelected) {
    die('Can\'t use db: ' . mysql_error());
}

// seleziono tutte le righe della tabella markers
$dbQuery = 'SELECT * FROM Percorsi_SOP2011 WHERE 1=1';
$result = @mysql_query($dbQuery);

if (!$result) {
    die('Invalid query: ' . mysql_error());
}

/* Creazione del documento */
$dom = new DOMDocument('1.0', 'UTF-8');
$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

// creo l'elemento kml e gli aggiungo il namespace
$node = $dom->createElementNS('http://earth.google.com/kml/2.1', 'kml');
$parNode = $dom->appendChild($node);

// creo l'elemento document e lo aggancio all'elemento kml
$node = $dom->createElement('document');
$docNode = $parNode->appendChild($node);

$count = 0;
// controllo le righe restituite dalla query
while ($row = @mysql_fetch_assoc($result)) {
  $count++;
  // creo l'elemento percorso e lo aggiungo al documento
  $node = $dom->createElement('PlaceMark');
  $dataNode = $docNode->appendChild($node);

  // creo un attributo id per distinguere il percorso
  $dataNode->setAttribute('id', $count);

  $pNode = $dom->createElement('percorso', 'percorso'.$row['idPercorso']);
  $dataNode->appendChild($pNode);
  $pdcNode = $dom->createElement('pdc', $row['idPDC']);
  $dataNode->appendChild($pdcNode);
  $addressNode = $dom->createElement('indirizzo', $row['indirizzoPDC']);
  $dataNode->appendChild($addressNode);
  $latNode = $dom->createElement('latitudine', $row['latPDC']);
  $dataNode->appendChild($latNode);
  $longNode = $dom->createElement('longitudine', $row['longPDC']);
  $dataNode->appendChild($longNode);
}

/* generazione file kml */
//$kmlOutput = $dom->saveXML();
//echo $kmlOutput;
//header('Content-type: application/vnd.google-earth.kml+xml');

$dom->save('percorsi.kml')
?>