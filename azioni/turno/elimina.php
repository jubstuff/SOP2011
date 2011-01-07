<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);

$v->isNotEmpty('elimina');
$v->isNotEmpty('codiceTurno');


$e = $v->getError();

if (empty($e)) {
	$clean = $v->getClean();
	if ($clean['elimina'] === 'SI') {
		$t = Turno::find_by_id($clean['codiceTurno']);
		//eliminalo
		$t->delete();
	}
	//redirect all'index dei turni
	$r = new Redirect(PUBLIC_URL . "/ATS/turni/");
	$r->doRedirect();
} else {
	//errori - possibile intrusione?
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}
?>
