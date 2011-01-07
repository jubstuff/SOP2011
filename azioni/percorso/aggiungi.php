<?php
require_once 'config.php';
require_once 'DB.php';
require_once 'DatabaseErrorException.php';
require_once 'Redirect.php';

$db = DB::getInstance();
$risposta = array();

//@todo validare la richiesta POST
$indiceArrivo = count($_POST['p'])-1;

$partenza = $_POST['p'][0]['codicePC'];
$arrivo = $_POST['p'][$indiceArrivo]['codicePC'];

$queryStr = "INSERT INTO Percorsi(partenza,arrivo) VALUES($partenza, $arrivo)";
try {
    $db->query($queryStr);
} catch (DatabaseErrorException $e) {
    $risposta['response'] = null;
    $risposta['query'] = $queryStr;
    echo json_encode($risposta);
    exit();
}

$percorsoID = $db->lastInsertId();

$queryStr2 = "INSERT INTO PERCORSO_PDC(codicePercorso, codicePC) VALUES ";
for($i=0; $i<$indiceArrivo; $i++) {
    $queryStr2 .= '(' . $percorsoID . ',' . $_POST['p'][$i]['codicePC'] . '),';
}
$queryStr2 .= '(' . $percorsoID . ',' . $_POST['p'][$indiceArrivo]['codicePC'] . ')';

try {
    $db->query($queryStr2);
    $risposta['response'] = 1;
} catch (DatabaseErrorException $e) {
    $risposta['response'] = null;
    $risposta['query'] = $queryStr2;
}
    echo json_encode($risposta);
?>
