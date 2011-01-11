<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
if (isset($_POST['submit'])) {
	$nome = $_POST['nome'];
	$cognome = $_POST['cognome'];
	$password = $_POST['password'];
	$matricola = '';
	$s = new Sorvegliante($nome, $cognome, $matricola, $password);
	$s->save();
	header("Location: ".$publicUrl."/ASC/sorveglianti/");
}
?>
