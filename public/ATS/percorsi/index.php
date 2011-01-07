<?php
require_once 'config.php';
require_once 'DB.php';

$db = DB::getInstance();
$queryStr = "SELECT codicePercorso, partenza, arrivo FROM Percorsi";




$pageTitle = "Gestione dei percorsi"; ?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle ?></h1>
<p><a href="nuovo.php">Inserisci nuovo percorso</a></p>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
