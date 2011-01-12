<?php
session_start();
require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);
$v->isNotEmpty('matricola');
$v->isNotEmpty('nome');
$v->isNotEmpty('cognome');
$v->isNotEmpty('codiceSquadra');

$v->isNumeric('matricola');
$v->isAlnum('nome');
$v->isAlnum('cognome');
$v->isNumeric('codiceSquadra');

$e = $v->getError();
$clean = $v->getClean();

if (empty($e)) {	
	//tutto ok
	//recupera sorvegliante dal db
	$s = Sorvegliante::find_by_id($clean['matricola']);
	//aggiorna i suoi dati
	$s->setNome($clean['nome']);
	$s->setCognome($clean['cognome']);
	$s->setCodiceSquadra($clean['codiceSquadra']);
	
	//salvalo nel db
	$s->update();
	//redirect all'index dei sorveglianti
	$r = new Redirect(PUBLIC_URL."/ASC/sorveglianti/");
	$r->doRedirect();
} else {
	//errori - possibile intrusione?
	$_SESSION['clean'] = $clean;
	$_SESSION['errors'] = $e;
	$r = new Redirect(PUBLIC_URL . '/ASC/sorveglianti/modifica.php?matricola='.$clean['matricola']);
	$r->doRedirect();
}
?>
