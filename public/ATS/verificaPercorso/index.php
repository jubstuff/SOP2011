<?php
require_once 'config.php';
$pageTitle = "Carica file percorsi";

$salvaUrl = 'salvaXML.php';

?>

<?php include HELPERS_DIR . '/testata.php'; ?>

<form action="<?php echo $salvaUrl; ?>" method="post" enctype="multipart/form-data" >
    <p>
        <label>Seleziona il file da processare:</label>
        <input id="id_file" name="turno" type="file" />
    </p>
    <p>
        <input type="submit" value="Processa file" />
    </p>
</form>

<?php include HELPERS_DIR . '/piepagina.php'; ?>