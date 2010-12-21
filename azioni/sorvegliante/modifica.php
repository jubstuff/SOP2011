<?php
require_once 'config.php';
require_once 'Sorvegliante.php';

$id = '';
$nome = '';
$cognome = '';
$password = '';

extract($_POST, EXTR_IF_EXISTS);

$s = Sorvegliante::find_by_id($id);
$s->setNome($nome);
$s->setCognome($cognome);
$s->setPassword($password);
$s->update();

header("Location: ".$publicUrl."/ASC/sorveglianti/");
?>
