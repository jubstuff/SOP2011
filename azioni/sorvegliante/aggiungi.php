<?php
session_start();
require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);
$v->isNotEmpty('nome');
$v->isNotEmpty('cognome');
$v->isNotEmpty('password');
$v->isNotEmpty('codiceSquadra');

$v->isAlnum('nome');
$v->isAlnum('cognome');
$v->isNumeric('codiceSquadra');

$e = $v->getError();
$clean = $v->getClean();
if (empty($e)) {
	//tutto ok
	$matricola = ''; //la matricola viene inserita automaticamente da MySql
	$s = new Sorvegliante($clean['nome'], $clean['cognome'], $matricola, $clean['password'], $clean['codiceSquadra']);
	$s->save();
	$r = new Redirect(PUBLIC_URL . '/ASC/sorveglianti/');
	$r->doRedirect();
} else {
	//ci sono errori - redirigere al form
	$_SESSION['clean'] = $clean;
	$_SESSION['errors'] = $e;
	$r = new Redirect(PUBLIC_URL . '/ASC/sorveglianti/nuovo.php');
	$r->doRedirect();
}
?>
