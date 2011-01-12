<?php
require_once 'config.php';
require_once 'Utente.php';
require_once 'Redirect.php';
session_start();

Utente::logOut();

$r = new Redirect(PUBLIC_URL);
$r->doRedirect();



?>
