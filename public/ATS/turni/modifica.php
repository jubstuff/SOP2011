<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';
require_once 'Squadra.php';
require_once 'Percorso.php';

$selected = 'selected="selected"';
$checked = 'checked="checked"';
$pageTitle = "Modifica Turno";

$v = new Validator($_GET);

$v->isNotEmpty('codiceTurno');
$v->isNumeric('codiceTurno');
$e = $v->getError();
if (!empty($e)) {
	$r = new Redirect(PUBLIC_URL . '/error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$clean['codiceTurno'] = urldecode($clean['codiceTurno']);
$t = Turno::find_by_id($clean['codiceTurno']);
$squadre = Squadra::findAll();

$percorsiTurno = $t->getPercorsi();
$tuttiPercorsi = Percorso::findAll();

$modificaUrl = ACTION_URL . '/turno/modifica.php';
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<form id="modificaTurno" action="<?php echo $modificaUrl; ?>" method="post">
	<p>
		<label for="data">Data</label>
		<input id="data" name="data" type="text" value="<?php echo $t->getData(); ?>" />
	</p>
	<p>
		<label for="codiceSquadra">Squadra</label>
		<select id="codiceSquadra" name="codiceSquadra">
			<?php foreach ($squadre as $sq) : ?>
				<option value="<?php echo $sq['codiceSquadra']; ?>"
			<?php if ($t->getCodiceSquadra() == $sq['codiceSquadra'])
					echo $selected; ?>>
						<?php echo $sq['nomeSquadra']; ?>
			</option>
			<?php endforeach; ?>
		</select>
	</p>
	<fieldset id="percorsiWrapper">
		<div id="labelPercorsi">
	<?php foreach ($tuttiPercorsi as $p): ?>
		<p><input name="codiciPercorsi[]"
				  id="percorso<?php echo $p['codicePercorso']; ?>"
				  type="checkbox"
				  class="checkboxPercorso"
				  value="<?php echo $p['codicePercorso']; ?>"
				  <?php if (in_array($p['codicePercorso'], $percorsiTurno)) echo $checked; ?> />
			<label for="percorso<?php echo $p['codicePercorso']; ?>">Percorso <?php echo $p['codicePercorso']; ?></label></p>
	<?php endforeach; ?>
		</div>
		<div id="map"></div>
		<div id="panel"></div>
	</fieldset>
	<p>
		<input id="submit" name="submit" type="submit" value="Aggiorna Turno" />
		<input type="hidden" name="codiceTurno" value="<?php echo $t->getCodiceTurno(); ?>" />
	</p>
			</form>
<p><a href="../turni/">Indietro</a></p>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/lib/jquery-ui-1.8.7.custom.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=it"></script>
<script type="text/javascript" src="<?php echo PUBLIC_URL; ?>/js/turni/cercaPercorsiHover.js"></script>

<?php include HELPERS_DIR . '/piepagina.php'; ?>