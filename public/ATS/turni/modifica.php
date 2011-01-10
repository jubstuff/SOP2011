<?php
require_once 'config.php';
require_once 'Turno.php';
require_once 'Validator.php';
require_once 'Redirect.php';
require_once 'Squadra.php';

$selected = 'selected="selected"';
$pageTitle = "Modifica Turno";

$v = new Validator($_GET);
//@todo fare decodeurl su matricola
$v->isNotEmpty('codiceTurno');
$v->isNumeric('codiceTurno');
$e = $v->getError();
if (!empty($e)) {
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$t = Turno::find_by_id($clean['codiceTurno']);
$squadre = Squadra::findAll();



$modificaUrl = ACTION_URL . '/turno/modifica.php';
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<form action="<?php echo $modificaUrl; ?>" method="post">
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
	<p>
		<input id="submit" name="submit" type="submit" value="Aggiorna Turno" />
		<input type="hidden" name="codiceTurno" value="<?php echo $t->getCodiceTurno(); ?>" />
	</p>
			</form>
<?php include HELPERS_DIR . '/piepagina.php'; ?>