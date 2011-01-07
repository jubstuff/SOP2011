<?php
require_once 'config.php';
require_once 'DB.php';

$db = DB::getInstance();
$queryStr = "SELECT codicePercorso FROM Percorsi ORDER BY codicePercorso";
$result = $db->query($queryStr);

$percorsi = array();
while ($row = $result->fetch_assoc()) {
	$percorsi[] = $row['codicePercorso'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Prova recupera punti di controllo dal database</title>
		<link rel="stylesheet" type="text/css" href="<?php echo PUBLIC_URL . '/css/screen.css'; ?>"/>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>/lib/common.js"></script>
		<script type="text/javascript" src="creaPercorso.js"></script>
	</head>
	<body>
		<ul id="elencoPercorsi">
			<?php foreach ($percorsi as $value): ?>
				<li><a href="<?php echo $value; ?>">Percorso <?php echo $value; ?></a></li>
			<?php endforeach; ?>
		</ul>
		<div id="map">

		</div>
	</body>
</html>