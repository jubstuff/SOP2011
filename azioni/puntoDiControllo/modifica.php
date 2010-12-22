<?php
require_once 'config.php';
require_once 'PuntoDiControllo.php';

//@todo validare la richiesta POST
//echo "azioni/puntodicontrollo/modifica.php";
//var_dump($_POST);

$matricola = isset($_POST['id']) ? $_POST['id'] : '';
$indirizzo = isset($_POST['indirizzo']) ? $_POST['indirizzo'] : '';
$latitudine = isset($_POST['lat']) ? $_POST['lat'] : '';
$longitudine = isset($_POST['lng']) ? $_POST['lng'] : '';
$idTag = isset($_POST['idTag']) ? $_POST['idTag'] : '';
$codiceCliente = isset($_POST['codiceCliente']) ? $_POST['codiceCliente'] : '';



$p = PuntoDiControllo::find_by_id($matricola);
$p->setIndirizzo($indirizzo);
$p->setLatitudine($latitudine);
$p->setLongitudine($longitudine);
$p->setIdTag($idTag);
$p->setCodiceCliente($codiceCliente);
$p->update();

header("Location: ".$publicUrl."/ASC/puntiDiControllo/");
?>