<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
$pageTitle = "Amministra Sorveglianti";
$tuttiISorveglianti = Sorvegliante::findAll();
?>

<?php include HELPERS_DIR . '/testata.php'; ?>

<form action="percorsiKML.php" method="post">
    <p>
        <label>Seleziona il file da processare:</label>
        <input id="id_file" name="name_file" type="file"></input>
    </p>
    <p>
        <input type="submit" value="Processa file"></input>
    </p>
</form>

<?php include HELPERS_DIR . '/piepagina.php'; ?>