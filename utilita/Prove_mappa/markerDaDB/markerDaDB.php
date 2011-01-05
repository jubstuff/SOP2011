<?php
require_once 'config.php';
require_once 'DB.php';

$db = DB::getInstance();


$queryStr = "SELECT codicePC, indirizzo, latitudine, longitudine FROM PuntiDiControllo";
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
		<style type="text/css">
			#info {
				width:100%;
				text-align: center;
				font-size:130%;
				height: 40px;
				color:#00CC00;
			}

			#map {
				float:left;
			}
			#pdc {
				float:left;
				width:400px;
			}
			#percorsoWrap {
				float:left;
				width:300px;
			}
			#info{

				height: 20px;
			}
		</style>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="marker.js"></script>
   </head>
	<body>
		<h1>Recupera punti da DB</h1>
		<div id="info"></div>
		<div id="map"></div>
		<div id="pdc">
			<select id="luoghi" size="10">
				<?php foreach ($pdc as $luogo): ?>
					<option value="<?php echo $luogo['latitudine'] . ',' . $luogo['longitudine'] . ',' . $luogo['codicePC']; ?>"><?php
				echo trim($luogo['indirizzo']);
					?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div id="percorsoWrap">
			<table id="percorso">
				<thead>
					<tr>
						<th>Indirizzo</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
			
			<form id="salvaPercorso" action="salva.php" method="post">
				<p>
					<label for="nome">Nome Percorso</label>
					<input type="text" id="nome" name="nome" />
				</p>
				<p><input type="submit" value="Salva Percorso" name="salvaPercorso" /></p>
			</form>
			
			<!-- <button id="salvaPercorso" name="salvaPercorso">Salva Percorso</button> -->
		</div>
	</body>
</html>
