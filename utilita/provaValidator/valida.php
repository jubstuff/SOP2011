<?php
session_start();

require_once 'Validator.php';
require_once 'Redirect.php';

$v = new Validator($_POST);
$v->isNotEmpty('uno', "DEVI AGGIUNGERE IL CAMPO UNO!!");
$v->isNotEmpty('due');
$v->isNotEmpty('tre');
$v->isAlnum('uno');
$v->isNumeric('due');
$e = $v->getError();

if ( empty($e) ) {
	$r = new Redirect('success.php');
	$r->doRedirect();
} else {
	$_SESSION['clean'] = $v->getClean();
	$_SESSION['errors'] = $e;
	$r = new Redirect('form.php');
	$r->doRedirect();
}
?>
