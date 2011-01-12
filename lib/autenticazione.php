<?php
require_once 'Utente.php';
require_once 'Redirect.php';
session_start();

if(!Utente::isAuthenticated()) {
	$_SESSION['errors'][] = "La pagina che hai tentato di accedere richiede l'autenticazione";
	$r = new Redirect(PUBLIC_URL);
	$r->doRedirect();
}

?>
