<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
$id = '';
extract($_GET, EXTR_IF_EXISTS);
$s = Sorvegliante::find_by_id($id);
$s->delete();
unset($s);
header("Location: ".$publicUrl."/ASC/sorveglianti/");


?>
