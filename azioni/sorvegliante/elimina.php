<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);

$v->isNotEmpty('elimina');
$v->isNotEmpty('matricola');


$e = $v->getError();

if (empty($e)) {
	$clean = $v->getClean();
	if ($clean['elimina'] === 'SI') {
		//cancella sorvegliante
		//recupera sorvegliante dal db
		$s = Sorvegliante::find_by_id($clean['matricola']);
		//eliminalo
		$s->delete();
	}
	//redirect all'index dei sorveglianti
	$r = new Redirect(PUBLIC_URL . "/ASC/sorveglianti/");
	$r->doRedirect();
} else {
	//errori - possibile intrusione?
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}
?>
