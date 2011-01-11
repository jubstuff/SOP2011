<?php
require_once 'config.php';
require_once 'Utente.php';
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
	Utente::processLogin($username, $password);
} else {
	//ci sono errori - redirigere al form
	$_SESSION['clean'] = $clean;
	$_SESSION['errors'] = $e;
	$r = new Redirect(PUBLIC_URL . '/index.php');
	$r->doRedirect();
}

?>
