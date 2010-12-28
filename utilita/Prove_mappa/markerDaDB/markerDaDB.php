<?php
require_once 'config.php';
require_once 'DB.php';

$db = DB::getInstance();


$queryStr = "SELECT indirizzo, latitudine, longitudine FROM PuntiDiControllo";
$result = $db->query($queryStr);
$pdc = array();
while ($row = $result->fetch_assoc()) {
	$pdc[] = $row;
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
		<script type="text/javascript" src="marker.js"></script>
   </head>
	<body>
		<h1>Recupera punti da DB</h1>
		<form>
			<select id="luoghi">
				<?php foreach ($pdc as $luogo): ?>
					<option value="<?php echo $luogo['latitudine'] . ',' . $luogo['longitudine']; ?>"><?php
				echo trim($luogo['indirizzo']);
					?></option>
				<?php endforeach; ?>
			</select>
		</form>
	</body>
</html>
