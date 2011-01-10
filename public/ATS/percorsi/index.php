
<?php
require_once 'config.php';
require_once 'DB.php';
/*
 * Recupera tutti i percorsi e li salva in un array
 */
$pageTitle = "Gestione dei percorsi";
$db = DB::getInstance();
$queryStr = "SELECT codicePercorso FROM Percorsi ORDER BY codicePercorso";
$result = $db->query($queryStr);
$percorsi = array();
while ($row = $result->fetch_assoc()) {
	$percorsi[] = $row['codicePercorso'];
}
?>

<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle ?></h1>
<p><a href="nuovo.php">Inserisci nuovo percorso</a></p>
<ul id="elencoPercorsi">
	<?php foreach ($percorsi as $numPercorso): ?>
		<li><a href="<?php echo $numPercorso; ?>">Percorso <?php echo $numPercorso; ?></a></li>
	<?php endforeach; ?>
	</ul>
	<div id="map">
	</div>
<div id="panel">
	
</div>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=it"></script>
	<script type="text/javascript" src="recuperaPercorso.js"></script>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
