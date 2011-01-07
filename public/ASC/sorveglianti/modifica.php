<?php
require_once 'config.php';
require_once 'Sorvegliante.php';
require_once 'Validator.php';
require_once 'Redirect.php';
require_once 'Squadra.php';


$pageTitle = "Modifica Sorvegliante";
$modificaUrl = ACTION_URL . '/sorvegliante/modifica.php';
$selected = 'selected="selected"';

$squadre = Squadra::findAll();



$v = new Validator($_GET);
//@todo fare decodeurl su matricola
$v->isNotEmpty('matricola');
$v->isNumeric('matricola');

$e = $v->getError();
if (!empty($e)) {
	//@todo creare la pagina di errore generale
	$r = new Redirect('error.php');
	$r->doRedirect();
}

$clean = $v->getClean();
$s = Sorvegliante::find_by_id($clean['matricola']);
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle; ?></h1>
<form action="<?php echo $modificaUrl; ?>" method="post">
	<p>
		<label for="nome">Nome</label>
		<input id="nome" name="nome" type="text" value="<?php echo $s->getNome(); ?>" />
	</p>
	<p>
		<label for="cognome">Cognome</label>
		<input id="cognome" name="cognome" type="text" value="<?php echo $s->getCognome(); ?>" />
	</p>
	<p>
		<label for="codiceSquadra">Squadra</label>
		<select id="codiceSquadra" name="codiceSquadra">
			<?php foreach ($squadre as $sq) : ?>
				<option value="<?php echo $sq['codiceSquadra']; ?>"
			<?php if ($s->getCodiceSquadra() == $sq['codiceSquadra'])
					echo $selected; ?>>
						<?php echo $sq['nomeSquadra']; ?>
			</option>
			<?php endforeach; ?>
					</select>
				</p>
				<p>
					<input id="submit" name="submit" type="submit" value="Aggiorna Sorvegliante" />
					<input type="hidden" name="matricola" value="<?php echo $s->getMatricola(); ?>" />
				</p>
			</form>
<?php include HELPERS_DIR . '/piepagina.php'; ?>