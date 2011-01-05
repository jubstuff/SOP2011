<?php

require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);
$v->isNotEmpty('matricola');
$v->isNotEmpty('nome');
$v->isNotEmpty('cognome');

$v->isNumeric('matricola');
$v->isAlnum('nome');
$v->isAlnum('cognome');

$e = $v->getError();

if (empty($e)) {
	$clean = $v->getClean();
	//tutto ok
	//recupera sorvegliante dal db
	$s = Sorvegliante::find_by_id($clean['matricola']);
	//aggiorna i suoi dati
	$s->setNome($clean['nome']);
	$s->setCognome($clean['cognome']);
	//salvalo nel db
	$s->update();
	//redirect all'index dei sorveglianti
	$r = new Redirect(PUBLIC_URL."/ASC/sorveglianti/");
	$r->doRedirect();
} else {
	//errori - possibile intrusione?
	//@todo creare la pagina di errore generale

	$r = new Redirect('error.php');
	$r->doRedirect();
}
?>
