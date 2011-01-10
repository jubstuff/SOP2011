<?php
session_start();
require_once 'config.php';
require_once 'DB.php';
require_once 'Squadra.php';

$pageTitle = "Aggiungi Turno";
$aggiungiUrl = ACTION_URL . '/turno/aggiungi.php';
$selected = 'selected="selected"';
$db = DB::getInstance();

$squadre = Squadra::findAll();

//@todo questo dovrebbe stare nella classe Percorso
$queryStr = "SELECT codicePercorso from Percorsi";
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
$default = array('data'=>'','codiceTurno'=>'','codiceSquadra'=>1, 'codicePercorso'=>'');

if (isset($_SESSION['errors'])) {
	$e = $_SESSION['errors'];
	$c = $_SESSION['clean'];

	$default = array_merge($default,$c);
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

		<form action="<?php echo $aggiungiUrl; ?>" method="post">
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
									  echo $selected; ?>><?php echo $s['nomeSquadra']; ?></option>
                                        <?php endforeach; ?>
				</select>
                        </p>
                        <p>
				<label for="codiciPercorsi[]">Percorso</label>
                                <select id="codiciPercorsi" name="codiciPercorsi[]" multiple="multiple">
					<?php foreach ($percorsi as $p) : ?>
						<option value="<?php echo $p['codicePercorso']; ?>"
								  <?php if ($default['codicePercorso'] == $p['codicePercorso'])
									  echo $selected; ?>>
						<?php echo $p['codicePercorso']; ?>
						</option>
                                        <?php endforeach; ?>
				</select>
                        </p>
                        <p>
				<input id="submit" name="submit" type="submit" value="Salva Turno" />
			</p>
		</form>
<?php include HELPERS_DIR . '/piepagina.php'; ?>