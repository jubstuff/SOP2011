<?php
session_start();
require_once 'config.php';
require_once 'DB.php';
require_once 'Squadra.php';

$pageTitle = "Aggiungi Turno";
$aggiungiUrl = ACTION_URL . '/turno/aggiungi.php';
$checked = 'checked="checked"';
$db = DB::getInstance();

$squadre = Squadra::findAll();

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

//il codice squadra di default è 1
$default = array('data' => '', 'codiceTurno' => '', 'codiceSquadra' => 1, 'codicePercorso' => '');

if (isset($_SESSION['errors'])) {
	$e = $_SESSION['errors'];
	$c = $_SESSION['clean'];

	$default = array_merge($default, $c);
	var_dump($default);
	unset($_SESSION['errors']);
	unset($_SESSION['clean']);
}
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1>Aggiungi nuovo turno</h1>

<?php if (isset($e)) : ?>
	<ul class="errorList">
<?php foreach ($e as $error) : ?>
			<li><?php echo $error; ?></li>
<?php endforeach; ?>
	</ul>
<?php endif; ?>

	<form id="nuovoTurno" action="<?php echo $aggiungiUrl; ?>" method="post">
			<p>
				<label for="data">Data</label>
				<input id="data" name="data" type="text" value="<?php echo $default['data']; ?>" />
			</p>
			<p>
				<label for="codiceSquadra">Squadra</label>
				<select id="codiceSquadra" name="codiceSquadra">
<?php foreach ($squadre as $s) : ?>
						<option value="<?php echo $s['codiceSquadra']; ?>"
<?php if ($default['codiceSquadra'] == $s['codiceSquadra'])
				echo $checked; ?>><?php echo $s['nomeSquadra']; ?></option>
					<?php endforeach; ?>
		</select>
	</p>
	<fieldset id="percorsiWrapper">
	<?php foreach ($percorsi as $p): ?>
		<p><input name="codiciPercorsi[]"
				  id="percorso<?php echo $p['codicePercorso']; ?>"
				  type="checkbox"
				  value="<?php echo $p['codicePercorso']; ?>"
				  <?php if ($default['codicePercorso'] == $p['codicePercorso']) echo $checked; ?> />
			<label for="percorso<?php echo $p['codicePercorso']; ?>">Percorso <?php echo $p['codicePercorso']; ?></label></p>
	<?php endforeach; ?>
	</fieldset>
	<p>
		<input id="submit" name="submit" type="submit" value="Salva Turno" />
	</p>
</form>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/lib/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="<?php echo PUBLIC_URL; ?>/js/caricaDatePicker.js"></script>
<?php include HELPERS_DIR . '/piepagina.php'; ?>