<?php
require_once 'config.php';
$pageTitle = "Carica file percorsi";
?>

<?php include HELPERS_DIR . '/testata.php'; ?>

<form action="salvaXML.php" method="post">
    <p>
        <label>Seleziona il file da processare:</label>
        <input id="id_file" name="turno" type="file" />
    </p>
    <p>
        <input type="submit" value="Processa file" />
    </p>
</form>

<?php include HELPERS_DIR . '/piepagina.php'; ?>