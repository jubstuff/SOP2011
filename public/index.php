<?php
require_once 'config.php';
$pageTitle = "Sistema Informativo SOP 2011";
?>
<?php include HELPERS_DIR . '/testata.php'; ?>

<h1><?php echo $pageTitle; ?></h1>
<p>Cosa vuoi fare?</p>
<ul>
	<li><a href="ASC/">Amministrare clienti e sorveglianti</a></li>
	<li><a href="ATS/">Amministrare turni e percorsi</a></li>
	<li><a href="Sorvegliante/">[Sorvegliante] Visualizzare i miei turni e percorsi</a></li>
</ul>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
