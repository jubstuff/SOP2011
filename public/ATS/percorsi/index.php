
<?php
require_once 'config.php';
require_once 'DB.php';

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
	<?php foreach ($percorsi as $value): ?>
		<li><a href="<?php echo $value; ?>">Percorso <?php echo $value; ?></a></li>
	<?php endforeach; ?>
	</ul>
	<div id="map">

	</div>



	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>/lib/common.js"></script>
	<script type="text/javascript" src="recuperaPercorso.js"></script>
<?php include HELPERS_DIR . '/piepagina.php'; ?>
