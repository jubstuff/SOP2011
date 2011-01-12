<?php require_once 'config.php';
require_once 'autenticazione.php';

$pageTitle = "Amministrazione turni e percorsi"; ?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle ?></h1>
<ul>
	<li><a href="turni/">Gestione Turni </a></li>
	<li><a href="percorsi/">Gestione Percorsi</a></li>
	<li><a href="verificaPercorso">Verifica percorsi</a></li>
</ul>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
