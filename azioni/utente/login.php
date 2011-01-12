<?php

require_once 'config.php';
require_once 'Utente.php';
require_once 'Redirect.php';
require_once 'Validator.php';

session_start();

$v = new Validator($_POST);
//@todo validare anche altro?
$v->isNotEmpty('username');
$v->isNotEmpty('password');
$v->isNotEmpty('ruolo');

$e = $v->getError();
$clean = $v->getClean();
if (empty($e)) {
	//tutto ok
	$username = $clean['username'];
	$password = $clean['password'];
	$ruolo = $clean['ruolo'];

	$validLogin = Utente::processLogin($username, $password, $ruolo);

	if (!$validLogin) {
		//login non valido
		$_SESSION['errors'][] = "Login non valido";
		$r = new Redirect(PUBLIC_URL . '/index.php');
		$r->doRedirect();
	} else {
		switch ($ruolo) {
			case 'ATS':
				$url = PUBLIC_URL . '/ATS/';
				break;
			case 'ASC':
				$url = PUBLIC_URL . '/ASC/';
				break;
			case 'SOR':
				$url = PUBLIC_URL . '/Sorvegliante/';
				break;
			default:
				$url = PUBLIC_URL . '/error.php';
				break;
		}
		$r = new Redirect($url);
		$r->doRedirect();
	}
} else {
	//ci sono errori - redirigere al form
	$_SESSION['errors'] = $e;
	$r = new Redirect(PUBLIC_URL . '/index.php');
	$r->doRedirect();
}
?>
