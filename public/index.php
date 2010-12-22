<?php
require_once 'config.php';
$pageTitle = "Sistema Informativo SOP 2011";
?>
<?php include HELPERS_DIR . '/testata.php'; ?>

<h1><?php echo $pageTitle; ?></h1>
<p>Cosa vuoi fare?</p>
<ul>
	<li><a href="ASC/">Amministrare clienti e sorveglianti</a></li>
	<li><a href="">Amministrare turni e percorsi[Non disponibile]</a></li>
	<li><a href="">[Sorvegliante] Visualizzare i miei turni e percorsi[Non disponibile]</a></li>
</ul>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
