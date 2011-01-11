<?php

require_once 'config.php';
require_once 'DB.php';
require_once 'DatabaseErrorException.php';
require_once 'Redirect.php';
require_once 'Validator.php';

$db = DB::getInstance();
$risposta = array();

$v = new Validator($_POST);
$v->isArray('p');

$e = $v->getError();
$clean = $v->getClean();
if (empty($e)) {
	//tutto ok
	$indiceArrivo = count($clean['p']) - 1;

	$partenza = $clean['p'][0]['codicePC'];
	$arrivo = $clean['p'][$indiceArrivo]['codicePC'];

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

	$temp = array();
	foreach($clean['p'] as $pdc){
		$temp[] = "(" . $percorsoID . ", " . $pdc['codicePC'] . ")";
	}
	$listaPDC = implode(',', $temp);
	$queryStr2 = "INSERT INTO PERCORSO_PDC(codicePercorso, codicePC) VALUES $listaPDC";


	try {
		$db->query($queryStr2);
		$risposta['response'] = 1;
	} catch (DatabaseErrorException $e) {
		$risposta['response'] = null;
		$risposta['query'] = $queryStr2;
	}
	echo json_encode($risposta);
} else {
	//ci sono errori - redirigere al form
}
?>
