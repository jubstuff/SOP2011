<?php
session_start();
require_once 'config.php';
require_once 'Turno.php';
require_once 'Sorvegliante.php';

$pageTitle = "Gestione turni";

$sorveglianteID = $_SESSION['sorveglianteID'];
$sorvegliante = Sorvegliante::find_by_id($sorveglianteID);
$tuttiITurni = Turno::find_by_codice_squadra($sorvegliante->getCodiceSquadra());
?>
<?php include HELPERS_DIR . '/testata.php'; ?>
<h1><?php echo $pageTitle ?></h1>
<?php if (is_array($tuttiITurni) && !empty($tuttiITurni)) :
	$squadra = $tuttiITurni[0]['nomeSquadra']; ?>
	<p>Ciao <?php echo $sorvegliante->getNome(), ' ', $sorvegliante->getCognome(); ?>. Sei nella squadra <strong><?php echo $squadra; ?></strong></p>
	<table>
		<tr>
			<th>Data</th>
			<th>Turno</th>
		</tr>
<?php
	foreach ($tuttiITurni as $t) :
		$codiceTurno = $t['codiceTurno'];
?>
		<tr>
			<td><?php echo $t['data']; ?></td>
			<td><a href="dettagliTurno.php?codiceTurno=<?php echo $codiceTurno; ?>">Visualizza turno</a></td>
		</tr>
<?php
		endforeach;
	else: ?>
		<p>Non ci sono turni per la tua squadra</p>
	<?php endif; ?>
	</table>
	<?php include HELPERS_DIR . '/piepagina.php'; ?>
