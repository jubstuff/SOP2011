<?php
require_once 'config.php';
require_once 'PuntoDiControllo.php';

$codicePC = '';
$indirizzo = '';
$latitudine = '';
$longitudine = '';
$idTag = '';
$codiceCliente = '';

extract($_POST, EXTR_IF_EXISTS);

$p = PuntoDiControllo::find_by_id($codicePC);
$p->setIndirizzo($indirizzo);
$p->setLatitudine($latitudine);
$p->setLongitudine($longitudine);
$p->setIdTag($idTag);
$p->setCodiceCliente($codiceCliente);
$p->update();

header("Location: ".$publicUrl."/ASC/puntiDiControllo/");
?>