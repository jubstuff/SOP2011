
<?php
require_once 'config.php';
require_once 'DB.php';
require_once 'Percorso.php';
$pageTitle = "Gestione dei percorsi";

/*
 * Recupera tutti i percorsi e li salva in un array
 */
$percorsi = Percorso::findAll();
?>

<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle ?></h1>
<p><a href="nuovo.php">Inserisci nuovo percorso</a></p>
<ul id="elencoPercorsi">
	<?php foreach ($percorsi as $p): ?>
		<li><a href="<?php echo $p['codicePercorso']; ?>">Percorso <?php echo $p['codicePercorso']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	<div id="map"></div>
<div id="panel">
	
</div>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=it"></script>
	<script type="text/javascript" src="<?php echo PUBLIC_URL; ?>/js/percorsi/recuperaPercorso.js"></script>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
