<?php
require_once 'Validator.php';

$v = new Validator($_POST);
$v->isNotEmpty('uno', "DEVI AGGIUNGERE IL CAMPO UNO!!");
$v->isNotEmpty('due');
$v->isNotEmpty('tre');
$v->isAlnum('uno');
$v->isNumeric('due');
$e = $v->getError();

if ( empty($e) ) {
	echo 'Tutto ok';
} else {
	foreach ($e as $error) {
		echo '<p style="color:#F00">'.$error.'</p>';
	}
}
?>
