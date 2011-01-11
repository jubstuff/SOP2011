<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);
$v->isNotEmpty('codiceTurno');
$v->isNotEmpty('codiceSquadra');
$v->isNotEmpty('data');
$v->isArray('codiciPercorsi');

$v->isNumeric('codiceTurno');
$v->isNumeric('codiceSquadra');

$e = $v->getError();
$clean = $v->getClean();
if (empty($e)) {
	$clean = $v->getClean();
	//tutto ok
	//recupera sorvegliante dal db
	$t = Turno::find_by_id($clean['codiceTurno']);
	$vecchiPercorsi = $t->getPercorsi();
	$nuoviPercorsi = $clean['codiciPercorsi'];
	//aggiorna i suoi dati
	$t->setData($clean['data']);
	$t->setCodiceSquadra($clean['codiceSquadra']);
	$t->setPercorsi($nuoviPercorsi);
	//salvalo nel db
	$t->update($vecchiPercorsi);
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
