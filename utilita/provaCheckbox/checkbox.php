<?php
require_once 'config.php';
require_once 'DB.php';
require_once 'Squadra.php';

$pageTitle = "Prova con checkbox";
$db = DB::getInstance();
//@todo questo dovrebbe stare nella classe Percorso
$queryStr = "SELECT codicePercorso from Percorsi ORDER BY codicePercorso";
try {
	$result = $db->query($queryStr);
	$percorsi = array();
	while ($row = $result->fetch_assoc()) {
		$percorsi[] = $row;
	}
} catch (DatabaseErrorException $e) {
	echo __FILE__ . "Impossibile eseguire la query";
}
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<style type="text/css">
	#percorsiWrapper {
		width:150px;
}
	#percorsiWrapper p {
		border: 1px solid black;
}
</style>
<div id="map"></div>
<form id="nuovoTurno" action="visualizza.php" method="post">
	<fieldset id="percorsiWrapper">
	<?php foreach ($percorsi as $p): ?>
		<p><input name="percorsi[]" id="percorso<?php echo $p['codicePercorso']; ?>" type="checkbox" value="<?php echo $p['codicePercorso']; ?>" />
			<label for="percorso<?php echo $p['codicePercorso']; ?>">Percorso <?php echo $p['codicePercorso']; ?></label></p>
	<?php endforeach; ?>
	</fieldset>
	<p><input id="submit" name="submit" type="submit" value="Salva Turno" /></p>
</form>

<div id="panel"></div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=it"></script>
<script type="text/javascript" src="recuperaPercorso.js"></script>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
