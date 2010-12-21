<?php
require_once 'config.php';
require_once 'PuntoDiControllo.php';
$id = '';
extract($_GET, EXTR_IF_EXISTS);
$s = PuntoDiControllo::find_by_id($id);
$s->delete();
unset($s);
header("Location: ".$publicUrl."/ASC/puntiDiControllo/");


?>
