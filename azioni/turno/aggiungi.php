<?php

session_start();
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);
$v->isNotEmpty('codiceSquadra');
$v->isNotEmpty('data');
//$v->isNotEmpty('codiciPercorsi');

$v->isNumeric('codiceSquadra');

$e = $v->getError();
$clean = $v->getClean();
if (empty($e)) {
	//tutto ok
	$codiceTurno = ''; //il codiceTurno viene inserito automaticamente da MySql
	$t = new Turno($clean['data'], $clean['codiceSquadra']);
	$t->setPercorsi($_POST['codiciPercorsi']); //@todo validare i percorsi
	$t->save();
	$r = new Redirect(PUBLIC_URL . '/ATS/turni/');
	$r->doRedirect();
} else {
	//ci sono errori - redirigere al form
	$_SESSION['clean'] = $clean;
	$_SESSION['errors'] = $e;
	$r = new Redirect(PUBLIC_URL . '/ATS/turni/nuovo.php');
	$r->doRedirect();
}
?>
