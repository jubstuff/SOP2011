<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);
$v->isNotEmpty('codiceSquadra');
$v->isNotEmpty('data');
$v->isNumeric('codiceSquadra');

$e = $v->getError();
$clean = $v->getClean();
if (empty($e)) {
	$clean = $v->getClean();
	//tutto ok
	//recupera sorvegliante dal db
	$s = Turno::find_by_id($clean['codiceTurno']);
	//aggiorna i suoi dati
	$s->setData($clean['data']);
	$s->setCodiceSquadra($clean['codiceSquadra']);
	//salvalo nel db
	$s->update();
	//redirect all'index dei sorveglianti
	$r = new Redirect(PUBLIC_URL."/ATS/turni/");
	$r->doRedirect();
} else {
	//errori - possibile intrusione?
	//@todo creare la pagina di errore generale

	$r = new Redirect('error.php');
	$r->doRedirect();
}
?>
