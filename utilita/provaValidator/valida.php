<?php
require_once 'Validator.php';

$v = new Validator($_POST);
$v->isNotEmpty('uno');
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
